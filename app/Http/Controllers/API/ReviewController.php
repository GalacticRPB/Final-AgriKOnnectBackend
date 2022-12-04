<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\Delivered;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review'=>'required',
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
            $product_id = $request->input('product_id');
            $seller_id = $request->input('seller_id');
            $customer_id = $request->input('customer_id');
            $firstname = $request->input('firstname');
            $middlename = $request->input('middlename');
            $lastname = $request->input('lastname');
            $order_id = $request->input('order_id');
            $order_name = $request->input('order_name');
            $order_qty = $request->input('order_qty');
            $order_total = $request->input('order_total');

            $reviewItem = new Review;
            $reviewItem->product_id = $product_id;
            $reviewItem->seller_id = $seller_id;
            $reviewItem->customer_id = $customer_id;
            $reviewItem->firstname = $firstname;
            $reviewItem->middlename = $middlename;
            $reviewItem->lastname = $lastname;
            $reviewItem->order_id = $order_id;
            $reviewItem->order_name = $order_name;
            $reviewItem->order_qty = $order_qty;
            $reviewItem->order_total = $order_total;
            $reviewItem->review = $request->input('review');
            $reviewItem->save();

            $affected = Delivered::where('order_id', $order_id)->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Review Submitted Successfully',
            ]);
        }
    }

    public function showReview(Request $request, $id)
    {
        $review = Review::where('seller_id', $id)->get();

        return response()->json([
            'status'=>200,
            'review'=> $review,
        ]);
    }

    public function customerReview(Request $request, $id)
    {
        $customerReview = Review::where('customer_id', $id)->get();
        return response()->json([
            'status'=>200,
            'review'=> $customerReview,
        ]);
    }

    
}
