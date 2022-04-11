<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\ProvinceRepository\ProvinceRepository;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $cityRepository;
    protected $provinceRepository;

    public function __construct()
    {
        $this->cityRepository = new CityRepository();
        $this->provinceRepository = new ProvinceRepository();
    }

    public function all()
    {
        $cities = $this->cityRepository->all(['province']);
        $provinces = $this->provinceRepository->all();
        return ['cities' => $cities, 'provinces' => $provinces];
    }

    public function create(Request $request)
    {
        $cityData = [
            'name' => $request->name,
            'province_id' => $request->province_id
        ];
        $cityCreated = $this->cityRepository->create($cityData);
        $cityCreated['province'] = $cityCreated->province;
        return $cityCreated;
    }

    public function edit(Request $request)
    {

        $city = $this->cityRepository->find($request->id);
        $city['province'] = $city->province;
        return $city;
    }

    public function update(Request $request)
    {
        $cityData = [
            'name' => $request->name,
            'province_id' => $request->province_id
        ];
        $city=$this->cityRepository->find($request->id);
        $city->update($cityData);
        $city->province;
        return $city;
    }

    public function delete(Request $request)
    {

        $cityDeleted=$this->cityRepository->delete($request->id);
        return $cityDeleted;
    }
}
