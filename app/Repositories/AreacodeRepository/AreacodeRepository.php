<?php

namespace App\Repositories\AreacodeRepository;

use App\Models\Areacode;
use App\Repositories\Contract\BaseRepository;

class AreacodeRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model=Areacode::class;
    }

}
