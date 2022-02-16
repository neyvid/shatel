<?php

namespace App\Http\Controllers;

use App\Services\UploadService\UploadService;
use Illuminate\Http\Request;

class UploadImage extends Controller
{
    public function upload(Request $request)
    {

        $image=$request->file('file');
        return UploadService::Upload($image);
    }
}
