<?php

namespace App\Repositories\ProvinceRepository;

use App\Models\Province;
use App\Repositories\Contract\BaseRepository;

class ProvinceRepository extends BaseRepository
{
    public function __construct(){
        $this->model=Province::class;
    }

}
