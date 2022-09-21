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
        $users = $this->userRepository->all();
        $services = $this->serviceRepository->all();
        $products = $this->productRepository->all();
        return ['orders' => $orders, 'services' => $services, 'products' => $products, 'users' => $users];
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
        $file = $request->file->move(public_path().'/orderImport/', $fileName);
        Excel::import(new OrdersImport, $file);
        return $this->all();
    }

    public function create(Request $request)
    {
        $OrderPayableAmount = 0;
        $products = [];
        $services = [];
        $orderItems = [];
        if ($request->products) {
            foreach ($request->products as $key => $product_id) {
                $product = $this->productRepository->find($product_id);
                $products[$key] = $product;
                $OrderPayableAmount += $product->price;
            }
        }
        if ($request->services) {
            foreach ($request->services as $key => $service_id) {
                $service = $this->serviceRepository->find($service_id);
                $services[$key] = $service;
                $OrderPayableAmount += $service->total_price;
            }
        }
        $orderCreated = $this->orderRepository->create([
            'user_id' => $request->user_id,
            'price' => $OrderPayableAmount,
            'payable_amount' => $OrderPayableAmount - (($OrderPayableAmount * $request->discount_amount) / 100),
            'discount_amount' => $request->discount_amount,
            'status' => 0,
        ]);

        foreach ($products as $key => $product) {
            $orderItems[] = [
                'order_id' => $orderCreated->id,
                'price' => $product->price,
                'discount' => $product->discount,
                'payable_amount' => $product->price,
                'item_id' => $product->id,
                'item_type' => 'product'
            ];
        }
        foreach ($services as $key => $service) {

            $orderItems[] = [
                'order_id' => $orderCreated->id,
                'price' => $service->total_price,
                'discount' => $service->discount,
                'payable_amount' => $service->total_price,
                'item_id' => $service->id,
                'item_type' => 'service'
            ];
        }

        $orderCreateItems = $orderCreated->order_items()->createMany($orderItems);
        $orderCreated->user;
        $orderCreated->order_items;
        return ['order' => $orderCreated, 'orderItems' => $orderCreateItems];

    }

    public function edit(Request $request)
    {
        $order=$this->orderRepository->find($request->id);
        $order->order_items;
        $order->user;
        return $order;
    }


}
