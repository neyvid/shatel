<?php

namespace App\Repositories\CodeRepository;

use App\Models\Code;
use App\Repositories\Contract\BaseRepository;

class CodeRepository extends BaseRepository

{


    public function __construct()
    {
        $this->model = Code::class;
    }
}
