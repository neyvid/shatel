<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AreacodeRepository\AreacodeRepository;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\ProvinceRepository\ProvinceRepository;
use App\Repositories\TelecomcenterRepository\TelecomcenterRepository;
use Illuminate\Http\Request;

class AreacodeController extends Controller
{
    protected $areacodeRepository;
    protected $cityRepository;
    protected $provinceRepository;
    protected $telecomcenterRepository;

    public function __construct()
    {
        $this->areacodeRepository = new AreacodeRepository();
        $this->cityRepository = new CityRepository();
        $this->provinceRepository = new ProvinceRepository();
        $this->telecomcenterRepository = new TelecomcenterRepository();
    }

    public function all()
    {

        $areacodes = $this->areacodeRepository->allWith();
        $cities = $this->cityRepository->all();
        $provinces = $this->provinceRepository->all();
        $telecomcenters = $this->telecomcenterRepository->all();
        return ['areacodes' => $areacodes, 'cities' => $cities, 'provinces' => $provinces, 'telecomcenters' => $telecomcenters];
    }


    public function create(Request $request)
    {
        $areacodeData = [
            'areacode' => $request->areacode,
            'code' => $request->code,
            'city_id' => $request->city_id,
            'province_id' => $request->province_id,
            'telecomcenter_id' => $request->telecomcenter_id,
        ];
        $areacodeCreated = $this->areacodeRepository->create($areacodeData);
        $areacodeCreated->province;
        $areacodeCreated->city;
        $areacodeCreated->telecomcenter;
        return $areacodeCreated;
    }

    public function delete(Request $request)
    {

        $areacodeDeleted = $this->areacodeRepository->delete($request->id);
        return $areacodeDeleted;
    }

    public function edit(Request $request)
    {

        $areacode = $this->areacodeRepository->find($request->id);
//        $areacode->city;
//        $areacode->province;
//        $areacode->telecomcenter;
        return $areacode;
    }

    public function update(Request $request)
    {
        $data = [
            'areacode' => $request->areacode,
            'code' => $request->code,
            'city_id' => $request->city_id,
            'province_id' => $request->province_id,
            'telecomcenter_id' => $request->telecomcenter_id,
        ];
        $areacode=$this->areacodeRepository->find($request->id);
        $areacode->update($data);
        $areacode->city;
        $areacode->province;
        $areacode->telecomcenter;
        return $areacode;
    }
}
