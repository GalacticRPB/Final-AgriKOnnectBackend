<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Ongoing;
use App\Models\Order;
use App\Models\Orderitems;

class DeliveryController extends Controller
{
    public function orderforDelivery(Request $request)
    {
        $product_id = $request->input('product_id');
        $seller_id = $request->input('seller_id');
        $customer_id = $request->input('customerId');
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
        
        $outfordelivery = new Delivery;
        $outfordelivery->product_id = $product_id;
        $outfordelivery->seller_id = $seller_id;
        $outfordelivery->customerId = $customer_id;
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

        $affected = Order::where('id', $order_id)->delete();
        $affected = Orderitems::where('order_id', $order_id)->delete();

        return response()->json([
            'status'=>200,
            'message'=> 'Order is out for Delivery',
        ]);
    }

    public function showOutforDelivery(Request $request, $id)
    {
        $outforDelivery = Delivery::where('customerId', $id)->get();

        return response()->json([
            'status'=>200,
            'deliveries'=> $outforDelivery,
        ]);
    
        
    }
}
