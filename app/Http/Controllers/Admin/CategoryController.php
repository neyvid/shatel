<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function all()
    {
        $categories = $this->categoryRepository->all();
        foreach ($categories as $key => $category) {
            if ($category->parent !== null) {
                $category->parent;
            }
        }

        return $categories;
    }

    public function create(Request $request)
    {
        $categoryData = [
            'name' => $request->name,
            'parent_id' => $request->parent_id ? $request->parent_id : 0,
        ];
        $category = $this->categoryRepository->create($categoryData);
        $category->parent;
        return $category;
    }

    public function edit(Request $request)
    {
        $category = $this->categoryRepository->find($request->id);
        $categories=$this->categoryRepository->all()->except($request->id);;
        $category['parent'] = $category->parent;
        return ['category'=>$category,'categories'=>$categories];
    }

    public function update(Request $request)
    {
        $categoryData = [
            'name' => $request->name,
            'parent_id' => $request->parent_id

        ];
        $category = $this->categoryRepository->find($request->id);
        $category->update($categoryData);
        $category->parent;
        return $category;
    }

    public function delete(Request $request)
    {

        $category=$this->categoryRepository->find($request->id);
        $categories=$this->categoryRepository->all()->where('parent_id',$request->id);
        if(count($categories)!=0){
            return ['hasParent'=>true];
        }
        $category->delete();
    }
}
