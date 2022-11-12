<?php

namespace App\Repositories\EmailSubscribe;


use App\Repositories\Contract\BaseRepository;

class EmailSubscribeRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model=\App\Models\EmailSubscribe::class;
    }
}
