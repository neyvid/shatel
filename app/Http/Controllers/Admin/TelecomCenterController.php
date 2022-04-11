<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\TelecomcenterRepository\TelecomcenterRepository;
use Illuminate\Http\Request;

class TelecomCenterController extends Controller
{
    protected $telecomcenterRepository;
    protected $cityRepository;

    public function __construct()
    {
        $this->telecomcenterRepository = new TelecomcenterRepository();
        $this->cityRepository = new CityRepository();
    }

    public function all()
    {
        $telecomCenters = $this->telecomcenterRepository->all(['city']);
        $cities = $this->cityRepository->all();
        return ['cities' => $cities, 'telecomCenters' => $telecomCenters];

    }

    public function create(Request $request)
    {
        $telecomCenterData = [
            'name' => $request->name,
            'city_id' => $request->city_id
        ];
        $telecomCenterCreated = $this->telecomcenterRepository->create($telecomCenterData);
        $telecomCenterCreated->city;
        return $telecomCenterCreated;
    }

    public function delete(Request $request)
    {

        $telecomcenterDeleted = $this->telecomcenterRepository->delete($request->id);
        return $telecomcenterDeleted;
    }

    public function deleteAll(Request $request)
    {
        foreach ($request->all() as $item) {
            $this->telecomcenterRepository->delete($item);
        }

    }

    public function edit(Request $request)
    {
       $telecomeCenter=$this->telecomcenterRepository->find($request->id);
       $telecomeCenter->city;
       return $telecomeCenter;
    }
    public function update(Request $request)
    {
        $telecomcenterData = [
            'name' => $request->name,
            'city_id' => $request->city_id
        ];
        $telecomcenter=$this->telecomcenterRepository->find($request->id);
        $telecomcenter->update($telecomcenterData);
        $telecomcenter->city;
        return $telecomcenter;
    }
}
