<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\OrdersImport;
use App\Repositories\OrderRepository\OrderRepository;
use App\Repositories\ProductRepository\ProductRepository;
use App\Repositories\ServiceRepository\ServiceRepository;
use App\Repositories\UserRepository\UserRepository;
use App\Services\JalaliDate\JalaliDate;
use App\Services\Payment\OnlineGateWays\Zarinpall;
use App\Services\UploadService\UploadImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $userRepository;
    protected $serviceRepository;
    protected $productRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->userRepository = new UserRepository();
        $this->serviceRepository = new ServiceRepository();
        $this->productRepository = new ProductRepository();
    }

    public function all()
    {
        $orders = $this->orderRepository->all(['user', 'order_items']);

        $services = $this->serviceRepository->all();
        $products = $this->productRepository->all();

        return ['orders' => $orders, 'services' => $services, 'products' => $products];
    }

    public function orderDetail(Request $request)
    {
        $order = $this->orderRepository->find($request->id);
        $order_detail = $order->order_items;
        $order_item = [];
        foreach ($order_detail as $key => $orderItem) {
            if ($orderItem->item_type == 'service') {
                $order_item[] = $this->serviceRepository->find($orderItem->item_id);
                $order_item[$key]['order_type'] = $orderItem->item_type;
            };
            if ($orderItem->item_type == 'product')
                $order_item[] = $this->productRepository->find($orderItem->item_id);
            $order_item[$key]['order_type'] = $orderItem->item_type;


        }
        return $order_item;
    }

    public function import(Request $request)
    {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $file = $request->file->move(public_path(), $fileName);
        Excel::import(new OrdersImport, $file);
        return $this->all();
    }
}
