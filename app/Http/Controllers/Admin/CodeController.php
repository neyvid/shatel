<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CodeImport;
use App\Repositories\CodeRepository\CodeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class CodeController extends Controller
{
    protected $codeRepository;

    public function __construct()
    {
        $this->codeRepository = new CodeRepository();
    }

    public function all()
    {

        return $this->codeRepository->all();

    }
    public function create(Request $request){
        $codeDate = [
            'areacode' => $request->areacode,
            'code_id' => $request->code_id,
            'city' => $request->city,
            'province' => $request->province,
            'telecomcenter' => $request->telecomcenter,
        ];
        $codeCreated = $this->codeRepository->create($codeDate);
        return $codeCreated;
    }

    public function import(Request $request)
    {

        if ($request->file->getClientOriginalExtension() === 'xlsx') {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            if (File::exists(public_path() . '/codeImport')) {
                File::deleteDirectory(public_path() . '/codeImport');
            };
            $file = $request->file->move(public_path() . '/codeImport', $fileName);
            Excel::import(new CodeImport, $file);
            return ['status'=>true,'allData'=>$this->all()];
        } else {
            return ['status'=>false,'message'=> '(پسوند قابل قبول xlsx. می باشد)  فرمت فایل انتخابی صحیح نمی باشد.  '];
        }
    }
}
