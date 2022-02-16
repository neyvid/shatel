<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repositories\UserRepository\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function update(ProfileRequest $request)
    {


        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->mobile,

        ];
        if (empty($request->password)) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->image_src && $request->image_name) {
            $file_extention = Str::afterLast($request->image_name, '.');
            $new_file_name = \Illuminate\Support\Carbon::now()->format('Y-m-d') . Str::random('6') . '.' . $file_extention;
            if (!File::exists(public_path('profiles/') . $request->user()->id)) {
                File::makeDirectory(public_path('profiles/') . $request->user()->id);
            }
            if (!empty($request->image)) {
                unlink(public_path('profiles/') . $request->user()->id . '/' . $request->image);
            }
            $path = public_path('profiles/') . $request->user()->id . '/' . $new_file_name;
            Image::make($request->image_src)->save($path);
            $data['image'] = $new_file_name;
        }

        if ($request->user()->mobile !== $request->mobile) {
            $data['mobile_verified_at'] = null;
        }
        if ($request->user()->email !== $request->email) {
            $data['email_verified_at'] = null;
        }
        $request->user()->update($data);
        return $request->user();
    }
}
