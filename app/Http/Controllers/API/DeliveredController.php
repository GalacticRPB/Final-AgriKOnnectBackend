<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Delivered;

class DeliveredController extends Controller
{
    public function orderDelivered(Request $request)
    {
        $seller_id = $request->input('seller_id');
        $customerId = $request->input('customer_id');
        $order_id = $request->input('order_id');
        $order_name = $request->input('order_name');
        $order_price = $request->input('order_price');
        $order_qty = $request->input('order_qty');
        $order_total = $request->input('order_total');
        $firstname = $request->firstname;
        $middlename = $request->input('middlename');
        $lastname = $request->input('lastname');
        $contactNo = $request->input('contactNo');
        $shippingaddress = $request->input('shippingaddress');
        $modeofpayment = $request->input('modeofpayment');
        
        $outfordelivery = new Delivered;
        $outfordelivery->seller_id = $seller_id;
        $outfordelivery->customerId = $customerId;
        $outfordelivery->order_id = $order_id;
        $outfordelivery->order_name = $order_name;
        $outfordelivery->order_price = $order_price;
        $outfordelivery->order_qty = $order_qty;
        $outfordelivery->order_total = $order_total;
        $outfordelivery->firstname = $firstname;
        $outfordelivery->middlename = $middlename;
        $outfordelivery->lastname = $lastname;
        $outfordelivery->contactNo = $contactNo;
        $outfordelivery->shippingaddress = $shippingaddress;
        $outfordelivery->modeofpayment = $modeofpayment;
        $outfordelivery->save();

        $affected = Delivery::where('order_id', $order_id)->delete();

        return response()->json([
            'status'=>200,
            'message'=> 'Succefully Delivered',
        ]);
    }

    public function showOrderDelivered($user_id)
    {
        $delivered = Delivered::where('seller_id', $user_id)->get();

        return response()->json([
            'status'=>200,
            'delivered'=> $delivered,
        ]);
      
    }

    public function showOrderToReview($user_id)
    {
        $delivered = Delivered::where('customerId', $user_id)->get();

        return response()->json([
            'status'=>200,
            'delivered'=> $delivered,
        ]);
      
    }
}
