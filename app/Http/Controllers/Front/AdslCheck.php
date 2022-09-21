<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\User;
use App\Repositories\AreacodeRepository\AreacodeRepository;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\CodeRepository\CodeRepository;
use App\Repositories\OrderRepository\OrderRepository;
use App\Repositories\ProvinceRepository\ProvinceRepository;
use App\Repositories\UserRepository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;

class AdslCheck extends Controller
{
    protected $areacodeRepository;
    protected $provinceRepository;
    protected $cityRepository;
    protected $userRepository;
    protected $codeRepository;

    public function __construct()
    {
        $this->areacodeRepository = new AreacodeRepository();
        $this->provinceRepository = new ProvinceRepository();
        $this->cityRepository = new CityRepository();
        $this->userRepository = new UserRepository();
        $this->codeRepository = new CodeRepository();
        $this->orderRepository = new OrderRepository();
    }

    public function adslSupportCheck(Request $request)
    {

        $adslCheckData = [
            'areacode' => substr($request->phone_number, 1, 6),
        ];

        $isAreacode = $this->codeRepository->findBy($adslCheckData);

//        $isExistPhoneNumber = $this->userRepository->findBy(['phone_number_request' => substr($request->phone_number, 3, 8)]);
        $isOrderedPhoneNumber = $this->orderRepository->findBy(['phone_number_ordered' => substr($request->phone_number, 3, 8)]);
        $status=null;
        $areacodeIsExist=null;
        if($isAreacode != ' '){
            $status=true;
            $areacodeIsExist=$isAreacode;
            $areacodeIsExist['phone_number']= substr($request->phone_number, 3, 8);
        }
        if($isAreacode===null){
            $areacodeIsExist=null;

        }
        if($isOrderedPhoneNumber){
            $status=false;
        }
        return ['areacodeIsExist'=>$areacodeIsExist,'status'=>$status];


    }

    public function getProvinces()
    {

        $provinces = $this->provinceRepository->all();

        return $provinces;
    }

    public function getCitiesOfProvince(Request $request)
    {
        $province = $this->provinceRepository->find($request->id);
        $citiesOfProvince = $province->cities;
        return $citiesOfProvince;
    }

    public function resetSession()
    {
        if (session()->has('orderDetails')) {
            session()->forget('orderDetails');
        }

    }
}
