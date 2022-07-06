<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\SliderRepository\SliderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderRepository;

    public function __construct()
    {
        $this->sliderRepository = new SliderRepository();
    }

    public function all(Request $request)
    {

        $sliders = $this->sliderRepository->all()->where('status', 'فعال')->where('expire_date','>=',Carbon::now()->format('Y-m-d'))->where('start_date','<=',Carbon::now()->format('Y-m-d'));

        return $sliders;

    }
}
