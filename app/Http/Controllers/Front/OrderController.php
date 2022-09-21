<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Imports\OrdersImport;
use App\Models\User;
use App\Repositories\OrderRepository\OrderRepository;
use App\Repositories\UserRepository\UserRepository;
use App\Services\JalaliDate\JalaliDate;
use App\Services\Payment\OnlineGateWays\Zarinpall;
use App\Services\Sms\SendSms;
use App\Services\UploadService\UploadImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class  OrderController extends Controller
{
    protected $orderRepository;
    protected $userRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->userRepository = new UserRepository();
    }

    public function isExistMobileOrEmailCheck(Request $request)
    {
        if (!Auth::check()) {
            $whoIsRegister = !empty($request->personalData) ? "personalData" : "companyData";
            $isInfoExist = DB::table('users')->where('mobile', $request->$whoIsRegister['mobile'])->orWhere('email', $request->$whoIsRegister['email'])->get();
//        $isInfoExist = \Illuminate\Foundation\Auth\User::where('mobile', $request->$whoIsRegister['mobile'])->orWhere('email', $request->$whoIsRegister['email'])->get();

            if (count($isInfoExist) != 0) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function create(Request $request)
    {

        $createUser = Auth::user();
        if (session()->has('orderDetails')) {

            if (!Auth::check()) {

                $whoIsRegister = !empty($request->personalData) ? "personalData" : "companyData";
                $data = [
                    'mobile' => $request->$whoIsRegister['mobile'],
                    'name' => $request->$whoIsRegister['name'],
                    'lastname' => $request->$whoIsRegister['lastname'],
                    'email' => $request->$whoIsRegister['email'],
                    'father_name' => $request->$whoIsRegister['father_name'],
                    'birthday_date' => JalaliDate::convert_jalali_to_miladi($request->$whoIsRegister['birthday_date']),
                    'national_code' => $request->$whoIsRegister['national_code'],
                    'postal_code' => $request->$whoIsRegister['postal_code'],
                    'address' => $request->$whoIsRegister['address'],
                    'gender' => $request->$whoIsRegister['gender'],
                    'user_type' => $whoIsRegister == 'personalData' ? 0 : 1,
                    'user_kind' => $whoIsRegister == 'personalData' ? 0 : 1,
                    'password' => Hash::make($request->$whoIsRegister['national_code']),
                    'areacode_id' => $request->orderDetails['id'],
                    'phone_number_request' => $request->orderDetails['phoneNumber'],
                    'email_verified_at' => Carbon::now(),
                    'mobile_verified_at' => Carbon::now(),
                ];
                if ($whoIsRegister == 'companyData') {
                    $data['company_name'] = $request->companyData['company_name'];
                    $data['user_phone_number'] = $request->companyData['user_phone_number'];
                    $data['registration_number'] = $request->companyData['registration_number'];
                    $data['registration_number_date'] = JalaliDate::convert_jalali_to_miladi($request->companyData['registration_number_date']);
                    $data['economic_number'] = $request->companyData['economic_number'];
                    $data['agent_nationality'] = $request->companyData['agent_nationality'];
                    $data['company_type'] = $request->companyData['company_type'];
                }
                $createUser = $this->userRepository->create($data);
                Auth::attempt(['email' => $createUser->email, 'password' => $request->$whoIsRegister['national_code']], true);
                $loginInfoText = 'سامانه خرید بسته اینترنتی صبا نت
نام کاربری : ' . $request->$whoIsRegister['mobile'] . '
رمز عبور : کد ملی شما';
                if ($request->$whoIsRegister['national_code_pic_name'] && $request->$whoIsRegister['national_code_pic_src']) {
                    $new_file_name = UploadImageService::image_upload($request->$whoIsRegister['national_code_pic_src'], $request->$whoIsRegister['national_code_pic_name'], null, "/userNationalPic/", $createUser->id);
                    $createUser->national_code_picture = $new_file_name;
                    $createUser->save();
                }
                SendSms::sendSms($request->$whoIsRegister['mobile'], $loginInfoText);
            }

            $servicePrice = $request->selectService['total_price'];
            $productPrice = $request->selectProduct != null ? $request->selectProduct['price'] : 0;
            $pricePayableOrder = $servicePrice + $productPrice;
            if ($request->order_discount) {
                $discountPercent = $request->order_discount / 100;
                $valueOfDiscount = $pricePayableOrder * $discountPercent;
                $pricePayableOrder = $pricePayableOrder - $valueOfDiscount;
            }

            $orderData = [
                'user_id' => $createUser->id,
                'price' => $pricePayableOrder,
                'payable_amount' => $pricePayableOrder,
                'discount_amount' => $request->order_discount ? $request->order_discount : 0,
                'status' => 0,
                'phone_number_ordered' => session('orderDetails.phoneNumber'),

            ];

            $orderCreate = $this->orderRepository->create($orderData);
            $orderItems = [
                [
                    'order_id' => $orderCreate->id,
                    'price' => $request->selectService['total_price'],
                    'discount' => $request->selectService['discount'],
                    'payable_amount' => $request->selectService['total_price'],
                    'item_id' => $request->selectService['id'],
                    'item_type' => 'service'
                ]

            ];

            if ($request->selectProduct != null) {
                array_push($orderItems,
                    [
                        'order_id' => $orderCreate->id,
                        'price' => $request->selectProduct['price'],
                        'discount' => $request->selectProduct['discount'],
                        'payable_amount' => $request->selectProduct['price'],
                        'item_id' => $request->selectProduct['id'],
                        'item_type' => 'product'
                    ]
                );
            }

            $orderCreateItems = $orderCreate->order_items()->createMany($orderItems);
            if ($orderCreateItems) {
                session(['orderId' => $orderCreate->id]);
                $gateWay = new Zarinpall();
                $Authority = $gateWay->paymentRequest([
                    'Amount' => $orderCreate->payable_amount,
                    'Description' => 'توضیخات',
                    'Email' => $createUser->email,
                    'Mobile' => $createUser->mobile,
                ]);
                session()->forget('orderDetails');
                return ['status' => true, 'Authority' => $Authority];
            }

        } else {

            return ['status' => false];
        }

    }


    public function verifyPayment(Request $request)
    {

        $status = $request->Status;
        $Authority = $request->Authority;
        $zarinpal = new ZarinPall();
        $result = $zarinpal->verifyPayment($Authority, $status);

        return $result;
    }

}
