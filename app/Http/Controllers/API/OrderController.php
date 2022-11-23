<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function index($user_id)
    {

        $orders = Order::where('seller_id', $user_id)->get();
        if($orders)
        {
            return response()->json([
                'status'=>200,
                'orders'=>$orders,
            ]);
        }
    }
}
