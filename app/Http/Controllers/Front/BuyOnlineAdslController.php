<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\AreacodeRepository\AreacodeRepository;
use App\Repositories\ProductRepository\ProductRepository;
use App\Repositories\ServiceRepository\ServiceRepository;
use App\Repositories\TelecomcenterRepository\TelecomcenterRepository;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;
use function MongoDB\BSON\toJSON;

class BuyOnlineAdslController extends Controller
{
    protected $areacodeRepository;
    protected $serviceRepository;
    protected $productRepository;
    public function __construct()
    {
        $this->areacodeRepository = new AreacodeRepository();
        $this->serviceRepository = new ServiceRepository();
        $this->productRepository = new ProductRepository();

    }

    public function buyOnline(Request $request)
    {
        $adslData = [
            'code' => $request->code,
            'areacode' => $request->areacode,
//            'province_id' => $request->province_id,
//            'city_id' => $request->city_id,
//            'telecomcenter_id' => $request->telecomcenter_id,

        ];
        $isAreacode = $this->areacodeRepository->findBy($adslData);
        if ($isAreacode != ' ') {
            self::resetSession();
            $isAreacode->city;
            $isAreacode->telecomcenter;
            $isAreacode->province;
            $isAreacode['phoneNumber']=$request->phoneNumber;
            session(['orderDetails' => $isAreacode]);
            return $isAreacode;
        }

        return false;

    }

    public function getOrderDetailsSession()
    {
        if (session()->has('orderDetails')) {
            $services=$this->serviceRepository->all()->where('telecomcenter_id',session('orderDetails')->telecomcenter_id);
            $products=$this->productRepository->all();
            return ['status' => true, 'orderDetails' => session('orderDetails'),'servicesDetails'=>$services,'products'=>$products];
        }
        return ['status' => false];
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
