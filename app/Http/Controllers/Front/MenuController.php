<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository\MenuRepository;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuRepository;

    public function __construct()
    {
        $this->menuRepository=new MenuRepository();
    }

    public function all()
    {
        $subMenus=$this->menuRepository->all()->where('parent_id',0);
        foreach ($subMenus as $menu){
                $menu->childrens;
        }
        return $subMenus;
    }
}
