<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MenuRepository\MenuRepository;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class MenusController extends Controller
{
    protected $menuRepository;

    public function __construct()
    {
        $this->menuRepository = new MenuRepository();
    }

    public function all()
    {
        $menus = $this->menuRepository->all(['childrens']);
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == 0) {
                $menus[$key]->parent = ['name' => 'منوی اصلی'];
            } else {
                $menu->parent;
            }
        }
        return $menus;
    }

    public function create(Request $request)
    {

        $menuData = [
            'name' => $request->name,
            'link' => env('app_url') . '/' . (substr($request->link, 0, 1) == '/' ? substr($request->link, 1) : $request->link),
            'parent_id' => $request->parent_id ? $request->parent_id : 0
        ];

        $menu = $this->menuRepository->create($menuData);
        if ($menu->parent_id == 0) {
            $menu->parent = ['name' => 'منوی اصلی'];
        } else {
            $menu->parent;
        }
        return $menu;
    }

    public function edit(Request $request)
    {
        $currentMenu = $this->menuRepository->find($request->id);
        $currentMenu->link = substr($currentMenu->link, strlen(env('app_url')));
        $allMenu = $this->menuRepository->all()->except($request->id);
        $currentMenu->parent;
        return ['menu' => $currentMenu, 'menus' => $allMenu];
    }

    public function update(Request $request)
    {
        $menuData = [
            'name' => $request->name,
            'link' => env('app_url') . '/' . (substr($request->link, 0, 1) == '/' ? substr($request->link, 1) : $request->link),
            'parent_id' => $request->parent_id ? $request->parent_id : 0
        ];
        $menu =$this->menuRepository->find($request->id);
        $menu->update($menuData);
        $menu->parent;
        return $menu;


    }
}
