<?php

namespace App\Repositories\SliderRepository;

use App\Models\Slider;
use App\Repositories\Contract\BaseRepository;

class SliderRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Slider::class;
    }

}
