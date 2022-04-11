<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Repositories\ProductRepository\ProductRepository;

use App\Services\UploadService\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function all()
    {
//        $this->equipmentRepository->all()->where('status',1);
        $products = $this->productRepository->all(['categories']);

        $categories = $this->categoryRepository->all();
        return ['products' => $products, 'categories' => $categories];
    }

    public function create(Request $request)
    {

        $productData = [
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'category_id' => $request->category_id
        ];
        $product = $this->productRepository->create($productData);
        $new_file_name=UploadImageService::image_upload($request->image_src,$request->image_name,$request->image_name_update,"/productImage/",$product->id);
        $product->image_name = $new_file_name;
        $product->save();
        $category = $this->categoryRepository->find($request->category_id);
        $product->categories()->attach($category);
        $product->categories;
        return $product;
    }

    public function edit(Request $request)
    {
        $product = $this->productRepository->find($request->id);
        $product->categories;
        return $product;
    }

    public function update(Request $request)
    {
        $productData = [
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'category_id' => $request->category_id
        ];
        $this->productRepository->update($request->id, $productData);
        $currentProduct=$this->productRepository->find($request->id);
        if($request->image_name_update && !empty($request->image_name_update)){
            unlink(public_path('/productImage/') . $currentProduct->id . '/' . $currentProduct->image_name);
            $new_file_name=UploadImageService::image_upload($request->image_src,$request->image_name,$request->image_name_update,"/productImage/",$request->id);
            $currentProduct->image_name = $new_file_name;
            $currentProduct->save();
        }

        $category = $this->categoryRepository->find($request->category_id);
        $productUpdated = $this->productRepository->find($request->id);
        $productUpdated->categories()->sync($category);
        $productUpdated->categories;
        return $productUpdated;
    }

    public function delete(Request $request)
    {
        $product = $this->productRepository->find($request->id);
        $product->categories()->detach();
        unlink(public_path('/productImage/') . $product->id . '/' . $product->image_name);
        rmdir(public_path('/productImage/') . $product->id );
        return $this->productRepository->delete($request->id);

    }

}
