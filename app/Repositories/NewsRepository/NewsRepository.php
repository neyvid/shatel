<?php

namespace App\Repositories\NewsRepository;

use App\Models\News;
use App\Repositories\Contract\BaseRepository;

class NewsRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model=News::class;
    }
}
