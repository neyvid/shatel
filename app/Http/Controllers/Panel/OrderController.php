<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Imports\OrdersImport;
use App\Repositories\OrderRepository\OrderRepository;
use App\Repositories\ProductRepository\ProductRepository;
use App\Repositories\ServiceRepository\ServiceRepository;
use App\Services\Payment\OnlineGateWays\Zarinpall;
use App\Services\UploadService\UploadImageService;
use App\Services\UploadService\UploadServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Util\Json;
use function MongoDB\BSON\toJSON;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $serviceRepository;
    protected $productRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->serviceRepository = new ServiceRepository();
        $this->productRepository = new ProductRepository();
    }

    public function orderDetail(Request $request)
    {
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
    }


    public function all(Request $request)
    {
        $current_user_id = Auth::user()->id;
        $orders_of_current_user = $this->orderRepository->all(['order_items'])->where('user_id', $current_user_id);
        $result = [];
        foreach ($orders_of_current_user as $key => $item) {
            $result[] = $item;

        }
        return $result;
    }

    public function orderPay(Request $request)
    {

        session(['orderId' => $request->id]);
        $gateWay = new Zarinpall();
        $Authority = $gateWay->paymentRequest([
            'Amount' => $request->payable_amount,
            'Description' => 'توضیخات',
            'Email' => Auth::user()->email,
            'Mobile' => Auth::user()->mobile,
        ]);

        return ['status' => true, 'Authority' => $Authority];

    }
}
