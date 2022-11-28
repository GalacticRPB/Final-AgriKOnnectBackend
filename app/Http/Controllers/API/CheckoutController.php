<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Shipping;
use App\Models\Orderitems;

use Symfony\Component\Console\Output\ConsoleOutput;

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

            $user_id = $request->customerId;
            $cart_id = $request->input('cart_id');
            $seller_id = $request->input('seller_id');
            $product_id = $request->input('product_id');
            $firstname = $request->input('firstname');
            $middlename = $request->input('middlename');
            $lastname = $request->input('lastname');

            $order = new Order;
            $order->user_id = $user_id;
            $order->cart_id = $cart_id;
            $order->seller_id = $seller_id;
            $order->product_id = $product_id;
            $order->firstname = $firstname;
            $order->middlename = $middlename;
            $order->lastname = $lastname;
            $order->shippingaddress = $request->input('shippingaddress');
            $order->mobilephone = $request->input('mobilephone');
            $order->modeofpayment = $request->input('modeofpayment');
            $order->save();
            
            $cart = Cart::where('user_id', $user_id )->where('id', $cart_id)->get();
            
            $orderItems = [];
            foreach($cart as $item)
            {
                $orderItems[] = [
                    'product_id'=>$item->product_id,
                    'order_id'=>$item->cart_id,
                    'seller_id'=>$item->seller_id,
                    'user_id'=>$item->user_id,
                    'qty'=>$item->fruits_qty,
                    'price'=>$item->price,
                    'order_name'=>$item->name,
                    'total_price'=>$item->price * $item->fruits_qty,
                ];

            }

            $order->order_items()->createMany($orderItems);
            
            $affected = Cart::where('id', $cart_id)->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Order Placed Successfully',
                'affected'=>$affected,
            ]);
        }
    }

    public function showToPay(Request $request, $id)
    {
        $toPay = Orderitems::where('user_id', $id)->get();
        
        return response()->json([
            'status'=>200,
            'toPay'=> $toPay,
        ]);

    }

   

}
