<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequest;
use App\Repositories\ProvinceRepository\ProvinceRepository;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    protected $provinceRepository;

    public function __construct()
    {
        $this->provinceRepository = new ProvinceRepository();
    }

    public function all()
    {
        return $this->provinceRepository->all();
    }

    public function edit(Request $request)
    {

        $provinceInfo = $this->provinceRepository->find($request->id);
        return $provinceInfo;
    }

    public function update(ProvinceRequest $request)
    {
        $data = [
            'name' => $request->name,
            'code' => $request->code,
        ];
        $province=$this->provinceRepository->find($request->id);
        $province->update($data);
        return $province;

    }

    public function delete(Request $request)
    {
        $provinceDeleted=$this->provinceRepository->delete($request->id);
        return $provinceDeleted;
    }

    public function create(ProvinceRequest $request)
    {
        $provinceData=[
            'name'=>$request->name,
            'code'=>$request->code,
        ];
        $provinceCreated=$this->provinceRepository->create($provinceData);
        return $provinceCreated;
    }
}
