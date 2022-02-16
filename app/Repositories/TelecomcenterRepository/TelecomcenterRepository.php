<?php

namespace App\Repositories\TelecomcenterRepository;

use App\Models\Telecomcenter;
use App\Repositories\Contract\BaseRepository;

class TelecomcenterRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model=Telecomcenter::class;
    }
}
