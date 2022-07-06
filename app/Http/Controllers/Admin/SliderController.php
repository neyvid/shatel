<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository\SliderRepository;
use App\Services\JalaliDate\JalaliDate;
use App\Services\UploadService\UploadImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderRepository;

    public function __construct()
    {
        $this->sliderRepository = new SliderRepository();
    }

    public function all()
    {
        $sliders = $this->sliderRepository->all();
        foreach ($sliders as $slider) {
            $slider['start_date'] = JalaliDate::convert_miladi_to_jalali($slider->start_date);
            $slider['expire_date'] = JalaliDate::convert_miladi_to_jalali($slider->expire_date);

        }
        return $sliders;
    }

    public function create(Request $request)
    {
        $start_date = JalaliDate::convert_jalali_to_miladi($request->start_date);
        $expire_date = JalaliDate::convert_jalali_to_miladi($request->expire_date);
        $isGreaterThan = JalaliDate::greaterThan($start_date, $expire_date);
        if ($isGreaterThan) {
            $sliderData = [
                'name' => $request->name,
                'link' => $request->link,
                'start_date' => $start_date,
                'expire_date' => $expire_date,
                'status' => $request->status ? 'فعال' : 'غیر فعال',
            ];

            $slider = $this->sliderRepository->create($sliderData);
            if ($slider && $request->slider_pic_name && $request->slider_pic_src) {
                $new_file_name = UploadImageService::image_upload($request->slider_pic_src, $request->slider_pic_name, null, "/slidersImage/", $slider->id);
                $slider->picture = $new_file_name;
                $slider->save();
            }
            $slider->start_date = JalaliDate::convert_miladi_to_jalali($slider->start_date);
            $slider->expire_date = JalaliDate::convert_miladi_to_jalali($slider->expire_date);
            return ['status' => true, 'slider' => $slider];
        } else {
            return ['status' => false, 'message' => '.تاریخ شروع باید قبل تر از تاریخ انقضاء باشد'];
        }

    }

    public function delete(Request $request)
    {
        $slider = $this->sliderRepository->find($request->id);
        unlink(public_path('/slidersImage/') . $slider->id . '/' . $slider->picture);
        rmdir(public_path('/slidersImage/') . $slider->id);
        $sliderDeleted = $this->sliderRepository->delete($request->id);

        return $sliderDeleted;
    }

    public function edit(Request $request)
    {
        $slider = $this->sliderRepository->find($request->id);
        $slider['start_date'] = JalaliDate::convert_miladi_to_jalali($slider->start_date);
        $slider['expire_date'] = JalaliDate::convert_miladi_to_jalali($slider->expire_date);

        return $slider;
    }

    public function update(Request $request)
    {


        $start_date = JalaliDate::convert_jalali_to_miladi($request->start_date);
        $expire_date = JalaliDate::convert_jalali_to_miladi($request->expire_date);
        $isGreaterThan = JalaliDate::greaterThan($start_date, $expire_date);
        $sliderData = [
            'name' => $request->name,
            'link' => $request->link,
            'start_date' => $start_date,
            'expire_date' => $expire_date,
            'status' => $request->status ? 'فعال' : 'غیر فعال',
        ];

        $slider=$this->sliderRepository->find($request->id);

        if($isGreaterThan){
            $slider->update($sliderData);
            if($request->slider_pic_name && $request->slider_pic_src){
                unlink(public_path('/slidersImage/') . $slider->id . '/' . $slider->picture);
                $new_slider_pic_name=UploadImageService::image_upload($request->slider_pic_src,$request->slider_pic_name,null,'/slidersImage/',$slider->id);
                $slider->picture=$new_slider_pic_name;
                $slider->save();
            }
            $slider['start_date']=JalaliDate::convert_miladi_to_jalali($slider->start_date);
            $slider['expire_date']=JalaliDate::convert_miladi_to_jalali($slider->expire_date);

            return ['status' => true, 'slider' => $slider];
        }

        return ['status' => false, 'message' => '.تاریخ شروع باید قبل تر از تاریخ انقضاء باشد'];
    }

}
