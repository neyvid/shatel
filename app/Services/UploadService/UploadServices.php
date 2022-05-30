<?php

namespace App\Services\UploadService;


use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UploadServices
{
    public static function Upload($image_src, $image_name, $image_name_update = null)
    {
        $file_extention = Str::afterLast($image_name, '.');
        $newName = \Illuminate\Support\Carbon::now()->format('Y-m-d') . Str::random('6') . '.' . $file_extention;
        $path = public_path() . '/' . $newName;
        File::put($path,$image_src);
        return $newName;

    }

}
