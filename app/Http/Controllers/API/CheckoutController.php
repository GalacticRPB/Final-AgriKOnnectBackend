<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Shipping;

class CheckoutController extends Controller
{
    public function placeorder(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'shippingaddress'=>'required',
            'mobilephone'=>'required',
            'modeofpayment'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages(),
            ]);
        }
        else 
        {
            $user_id = $request->user_id;
            $firstname = $request->firstname;
            $middlename = $request->middlename;
            $lastname = $request->lastname;

            $order = new Order;
            $order->user_id = $request->input('customerId');
            $order->firstname = $request->input('firstname');
            $order->middlename = $request->input('middlename');
            $order->lastname = $request->input('lastname');
            $order->shippingaddress = $request->input('shippingaddress');
            $order->mobilephone = $request->input('mobilephone');
            $order->modeofpayment = $request->input('modeofpayment');
            $order->tracking_no = "agrikOnnect".rand(1111,9999);
            $order->save();

            $cart = Cart::where('user_id', $user_id )->get();
            
            $orderItems = [];
            foreach($cart as $item)
            {
                $orderItems[] = [
                    'fruits_id'=>$item->fruits_id,
                    'qty'=>$item->fruits_qty,
                    'name'=>$item->name,
                    'price'=>$item->products->price,

                ];

                $item->products->update([
                    'qty'=>$item->products->quantity = $item->fruits_id
                ]);
            }

            $order->order_items()->createMany($orderItems);
            
            Cart::destroy($cart);

            return response()->json([
                'status'=>200,
                'message'=>'Order Placed Successfully',
            ]);
        }
    }
    
}
