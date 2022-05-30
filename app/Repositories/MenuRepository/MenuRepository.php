<?php

namespace App\Repositories\MenuRepository;

use App\Models\Menu;
use App\Repositories\Contract\BaseRepository;

class MenuRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model=Menu::class;
    }
}
