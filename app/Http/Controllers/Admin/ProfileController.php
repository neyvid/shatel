<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\File;


class ProfileController extends Controller
{
    public function update(ProfileRequest $request)
    {

        $data = $request->only('name', 'password', 'lastname', 'email', 'mobile', 'image', 'id');
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->image_name) {

//
            $file = $request->image_name;

            $file_name = Carbon::now('Asia/Tehran')->format('Y-m-d') . '_' . Str::random(5);
            $file_extension = Str::afterLast($request->image_name, '.');
            $new_name = $file_name . '.' . $file_extension;
            $path = public_path('profiles/') . $new_name;
//            زمانی که کد زیر باشه و فایل بصورت کامل داده بشه درست هست و فقط زمانی که ازفرم ارسال میکنم ارور میده!
//            $img = Image::make('I:\MOB-CELIN\20191228_104401.jpg');
            $img = Image::make($request->image_name);
            $img->save($path);

            $data['image'] = $new_name;
        }
        $request->user()->update($data);
        return $request->user();
    }
}
