<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderitems;

class OrderController extends Controller
{
    //
    public function index($user_id)
    {

        $orders = Orderitems::where('seller_id', $user_id)->get();
        if($orders)
        {
            $item = (Order::where('seller_id', $user_id)->get());
            return response()->json([
                'status'=>200,
                'order_items'=>$orders,
                'orders'=>$item
            ]);
        }
    }

    public function orderDetails($order_id)
    {
        $orderDetails = Order::where('id', $order_id)->get();
        if($orderDetails)
        {
            if(Orderitems::where('order_id', $order_id)->get())

            return response()->json([
                'status'=>200,
                'orders'=>$orderDetails,
                'order_items'=>$orderDetails
            ]);
        }
    }

    
}
