<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;

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
            $seller_id = $request->input('seller_id');
            $firstname = $request->input('firstname');
            $middlename = $request->input('middlename');
            $lastname = $request->input('lastname');
            $order_name = $request->input('order_name');
            $order_qty = $request->input('order_qty');
            $order_total = $request->input('order_total');
            

            $reviewItem = new Review;
            $reviewItem->seller_id = $seller_id;
            $reviewItem->firstname = $firstname;
            $reviewItem->middlename = $middlename;
            $reviewItem->lastname = $lastname;
            $reviewItem->order_name = $order_name;
            $reviewItem->order_qty = $order_qty;
            $reviewItem->order_total = $order_total;
            $reviewItem->review = $request->input('review');
            $reviewItem->save();

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
}
