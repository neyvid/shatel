<?php

namespace App\Services\UploadService;


use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Str;

class UploadService
{
    public static function Upload(UploadedFile $file)
    {

        $fileExtension = $file->getClientOriginalExtension();
        $newName = Carbon::now()->format('Y-m-d') . Str::random(4);
        $newFileName = $newName . '.' . $fileExtension;
        $file->move(config('upload.image_path'), $newFileName);
        return response([
            'data' => '/images/'. $newFileName
        ]);

    }

}
