<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\AreacodeRepository\AreacodeRepository;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\ProvinceRepository\ProvinceRepository;
use Illuminate\Http\Request;

class AdslCheck extends Controller
{
    protected $areacodeRepository;
    protected $provinceRepository;
    protected $cityRepository;

    public function __construct()
    {
        $this->areacodeRepository = new AreacodeRepository();
        $this->provinceRepository = new ProvinceRepository();
        $this->cityRepository = new CityRepository();
    }

    public function adslSupportCheck(Request $request)
    {
        $adslCheckData = [
            'code' => $request->city_code,
            'areacode' => substr($request->phone_number, 0, 4),
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
        ];
        $isAreacode = $this->areacodeRepository->findBy($adslCheckData);

        if ($isAreacode!=' ') {
            $isAreacode->city;
            $isAreacode->telecomcenter;
            $isAreacode->province;
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
}
