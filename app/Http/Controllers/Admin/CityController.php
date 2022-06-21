<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CityImport;
use App\Models\City;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\ProvinceRepository\ProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

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
        $city = $this->cityRepository->find($request->id);
        $city->update($cityData);
        $city->province;
        return $city;
    }

    public function delete(Request $request)
    {

        $cityDeleted = $this->cityRepository->delete($request->id);
        return $cityDeleted;
    }

    public function import(Request $request)
    {

        if ($request->file->getClientOriginalExtension() === 'xlsx') {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            if (File::exists(public_path() . '/cityImport')) {
                File::deleteDirectory(public_path() . '/cityImport');
            };
            $file = $request->file->move(public_path() . '/cityImport', $fileName);
            Excel::import(new CityImport, $file);
            return ['status'=>true,'allData'=>$this->all()];
        } else {
            return ['status'=>false,'message'=> '(پسوند قابل قبول xlsx. می باشد)  فرمت فایل انتخابی صحیح نمی باشد.  '];
        }
    }
}
