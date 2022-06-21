<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AreacodeRepository\AreacodeRepository;
use App\Repositories\CityRepository\CityRepository;
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
    public function __construct()
    {
        $this->areacodeRepository = new AreacodeRepository();
        $this->provinceRepository = new ProvinceRepository();
        $this->cityRepository = new CityRepository();
        $this->userRepository=new UserRepository();
    }

    public function adslSupportCheck(Request $request)
    {
        $adslCheckData = [
            'code' => $request->city_code,
            'areacode' => substr($request->phone_number, 0, 4),
//            'province_id' => $request->province_id,
//            'city_id' => $request->city_id,
        ];
        $isAreacode = $this->areacodeRepository->findBy($adslCheckData);
        $isExistPhoneNumber=$this->userRepository->findBy(['phone_number_request'=>$request->phone_number]);

        if ($isAreacode != ' ' && !$isExistPhoneNumber ) {
            $isAreacode->city;
            $isAreacode->telecomcenter;
            $isAreacode->province;
            $isAreacode['phoneNumber'] = $request->phone_number;
            return $isAreacode;
        }

        return false;

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
