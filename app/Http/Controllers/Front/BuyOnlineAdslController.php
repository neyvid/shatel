<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\AreacodeRepository\AreacodeRepository;
use App\Repositories\CodeRepository\CodeRepository;
use App\Repositories\ProductRepository\ProductRepository;
use App\Repositories\ServiceRepository\ServiceRepository;
use App\Repositories\TelecomcenterRepository\TelecomcenterRepository;
use App\Services\Sms\SendSms;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;
use function MongoDB\BSON\toJSON;

class BuyOnlineAdslController extends Controller
{
    protected $areacodeRepository;
    protected $serviceRepository;
    protected $productRepository;
    protected $codeRepository;


    public function __construct()
    {
        $this->areacodeRepository = new AreacodeRepository();
        $this->serviceRepository = new ServiceRepository();
        $this->productRepository = new ProductRepository();
        $this->codeRepository = new CodeRepository();

    }

    public function buyOnline(Request $request)
    {

        $adslData = [
            'areacode' => $request->areacode,
        ];
        $isAreacode = $this->codeRepository->findBy($adslData);
        if ($isAreacode != ' ') {
            self::resetSession();
            $isAreacode['phoneNumber'] = $request->phone_number;
            session(['orderDetails' => $isAreacode]);
            return $isAreacode;
        }

        return false;

    }

    public function getOrderDetailsSession()
    {
        if (session()->has('orderDetails')) {
            $services = $this->serviceRepository->all();
            $products = $this->productRepository->all();
            return ['status' => true, 'orderDetails' => session('orderDetails'), 'servicesDetails' => $services, 'products' => $products];
        }
        return ['status' => false];
    }

    public function cancelPurchase()
    {
        if (session()->has('orderDetails')) {
            session()->forget('orderDetails');
        }
        return true;
    }

    private static function checkSession()
    {
        if (session()->has('orderDetails')) {
            return true;
        }
        return false;
    }

    public static function resetSession()
    {
        if (self::checkSession()) {
            session()->forget('orderDetails');
        }

    }

}
