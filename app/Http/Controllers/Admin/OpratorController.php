<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\OpratorRepository\OpratorRepository;
use Illuminate\Http\Request;

class OpratorController extends Controller
{
    protected $opratorRepository;

    public function __construct()
    {
        $this->opratorRepository = new OpratorRepository();
    }

    public function all()
    {
        $optators = $this->opratorRepository->all();
        return $optators;
    }

    public function create(Request $request)
    {
        $opratorData = [
            'name' => $request->name];
        $oprator = $this->opratorRepository->create($opratorData);
        return $oprator;
    }

    public function delete(Request $request)
    {

        $opratorDeleted = $this->opratorRepository->delete($request->id);
        return $opratorDeleted;
    }

    public function edit(Request $request)
    {
        $oprator=$this->opratorRepository->find($request->id);
        return $oprator;
    }
    public function update(Request $request)
    {
        $opratorData=[
            'name'=>$request->name
        ];
        $oprator=$this->opratorRepository->find($request->id);
        $oprator->update($opratorData);
        return $oprator;
    }


}
