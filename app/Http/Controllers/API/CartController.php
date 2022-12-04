<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    public function addtoCart(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = $request->customerId;
        $seller_id = $request->seller_id;
        $fruits_qty = $request->fruits_qty;
        $name = $request->name;
        $price = $request->price;
        $image = $request->image;
   
        $cartItem = new Cart;
        $cartItem->user_id = $request->input('customerId');
        $cartItem->product_id = $product_id;
        $cartItem->seller_id = $seller_id;
        $cartItem->fruits_qty = $fruits_qty;
        $cartItem->name = $name;
        $cartItem->price = $price;
        $cartItem->image = $image;
        $cartItem->save();

        return response()->json([
            'status'=>201,
            'message'=> 'Added to cart',
        ]);
    }

    public function viewbasket(Request $request, $id) 
    {
        $cartItems = Cart::where('user_id', $id)->get();
        
        return response()->json([
            'status' => 200,
            'cart' => $cartItems,
        ]);
    }

    public function updatequantity($cart_id, $scope, $id)
    {
        $cartItems = Cart::where('id', $cart_id)->where('user_id', $id)->first();
        
        if($scope == 'inc')
        {
            $cartItems->fruits_qty += 1;
        }
        else if ($scope == 'dec')
        {
            $cartItems->fruits_qty -= 1;
        }
        $cartItems->update();
        return response()->json([
            'status'=>200,
            'message'=>'Quantity updated',
        ]);
        
    }
    public function checkoutDetails($user_id)
    {
        $cartItems = Cart::find($user_id);
        if($cartItems)
        {
            return response()->json([
                'status'=> 200,
                'cart' => $cartItems,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Product ID Found',
            ]);
        }
    }
}
