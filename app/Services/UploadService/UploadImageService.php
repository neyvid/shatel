<?php

namespace App\Services\UploadService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class UploadImageService
{
//    public static function is_image_in_request($request)
//    {
//        if ($request->image_src && ($request->image_name||$request->image_name_update)) {
//            return true;
//        }
//        return false;
//    }

    public static function is_image($image_src,$image_name,$image_name_update=null)
    {
        if ($image_src && ($image_name||$image_name_update)) {
            return true;
        }
        return false;
    }

    public static function get_file_extention(string $image_name)
    {
        return Str::afterLast($image_name, '.');
    }

    public static function create_new_file_name(string $file_extention)
    {
        return \Illuminate\Support\Carbon::now()->format('Y-m-d') . Str::random('6') . '.' . $file_extention;

    }

    public static function check_is_directory_exist(string $path_of_directory, $name_of_directory)
    {
        if (File::exists(public_path("$path_of_directory") . $name_of_directory)) {
            return true;
        }
        return false;
    }

    public static function create_new_directory(string $path_of_directory, $name_of_directory)
    {
        File::makeDirectory(public_path("$path_of_directory") . $name_of_directory, 0777, true, true);

    }

    public static function image_upload($image_src,$image_name,$image_name_update=null,string $path_of_directory,$name_of_directory)
    {
        if (self::is_image($image_src,$image_name,$image_name_update)) {
            $file_extention = self::get_file_extention($image_name ? $image_name:$image_name_update);
            $new_file_name=self::create_new_file_name($file_extention);
            if(!self::check_is_directory_exist($path_of_directory,$name_of_directory)){
                self::create_new_directory($path_of_directory,$name_of_directory);
            }
            $path = public_path("$path_of_directory") . $name_of_directory . '/' . $new_file_name;
            Image::make($image_src)->save($path);
            return $new_file_name;
        }

    }
}
