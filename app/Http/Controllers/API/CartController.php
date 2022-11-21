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
        $user_id = $request->user_id;
        $fruits_id = $request->fruits_id;
        $fruits_qty = $request->fruits_qty;
        $name = $request->name;
        $price = $request->price;

        $fruitCheck = Product::where('id', $fruits_id)->first();
        if($fruitCheck)
        {
            if(Cart::where('fruits_id', $fruits_id)->where('user_id', $user_id)->exists())
            {
                return response()->json([
                    'status'=>409,
                    'message'=> $fruitCheck->name. 'Already Added to cart',
                ]);
            }
            else
            {
                $cartItem = new Cart;
                $cartItem->user_id = $request->input('customerId');
                $cartItem->fruits_id = $fruits_id;
                $cartItem->fruits_qty = $fruits_qty;
                $cartItem->name = $name;
                $cartItem->price = $price;
                $cartItem->save();

                return response()->json([
                    'status'=>201,
                    'message'=> 'Added to cart',
                ]);
            }
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'Product not found'
            ]);
        }
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
    public function checkoutDetails($cart_id)
    {
        $cartItems = Cart::find($cart_id);
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
