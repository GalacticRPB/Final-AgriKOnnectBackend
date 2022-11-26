<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ongoing;
use App\Models\Order;
use App\Models\Orderitems;

class OngoingController extends Controller
{
    public function orderApproved(Request $request)
    {
        $seller_id = $request->input('seller_id');
        $order_id = $request->input('order_id');
        $order_name = $request->input('order_name');
        $order_price = $request->input('order_price');
        $order_qty = $request->input('order_qty');
        $order_total = $request->input('order_total');
        $firstname = $request->firstname;
        $middlename = $request->input('middlename');
        $lastname = $request->input('lastname');
        $mobilephone = $request->input('mobilephone');
        $shippingaddress = $request->input('shippingaddress');
        $modeofpayment = $request->input('modeofpayment');
        
    
        $ongoingItem = new Ongoing;
        $ongoingItem->seller_id = $seller_id;
        $ongoingItem->order_id = $order_id;
        $ongoingItem->order_name = $order_name;
        $ongoingItem->order_price = $order_price;
        $ongoingItem->order_qty = $order_qty;
        $ongoingItem->order_total = $order_total;
        $ongoingItem->firstname = $firstname;
        $ongoingItem->middlename = $middlename;
        $ongoingItem->lastname = $lastname;
        $ongoingItem->contactNo = $mobilephone;
        $ongoingItem->shippingaddress = $shippingaddress;
        $ongoingItem->modeofpayment = $modeofpayment;
        $ongoingItem->save();

        $affected = Order::where('id', $order_id)->delete();
        $affected = Orderitems::where('order_id', $order_id)->delete();
        return response()->json([
            'status'=>200,
            'message'=> 'Order Approved',
        ]);

        
    }

    public function showOngoing($user_id)
    {
        $toShip = Ongoing::where('seller_id', $user_id)->get();
        if($toShip)
        {
            return response()->json([
                'status'=>200,
                'ongoing'=> $toShip,
            ]);
    
        }
        
    }

    public function toShipDetails($order_id)
    {
        $toShipDetails = Ongoing::where('order_id', $order_id)->get();
        if($toShipDetails)
        {
            return response()->json([
                'status'=>200,
                'ongoing'=>$toShipDetails,
            ]);
        }
    }

}
