<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Delivered;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status'=> 200,
            'products'=>$products,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'category'=>'required|max:191',
            'name'=>'required|max:191',
            'description'=>'required|max:191',
            'price'=>'required|max:191',
            'quantity'=>'required|max:191',

        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        }
        else
        {
            $product = new Product;

            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('uploads/product/',$filename);
                $product->image = 'uploads/product/'.$filename;
            }

            $product->user_id = $request->input('user_id');
            $product->category = $request->input('category');
            $product->name = $request->input('name');
            $product->seller_name = $request->input('seller_name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->quantity = $request->input('quantity');
            $product->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Product Added Successfully',
            ]);
        }

    }

    public function edit($id)
    {
        $product = Product::find($id);
        if($product)
        {
            return response()->json([
                'status'=> 200,
                'product' => $product,
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'userId' => 'required',
            'category'=>'required|max:191',
            'name'=>'required|max:191',
            'description'=>'required|max:191',
            'price'=>'required|max:191',
            'quantity'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }
        else
        {
            $product = Product::find($id);
            if($product)
            {   
                $product->user_id = $request->input('userId');
                $product->category = $request->input('category');
                $product->name = $request->input('name');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
                $product->quantity = $request->input('quantity');
                $product->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Product Updated Successfully',
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

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product)
        {
            $product->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Product Deleted Successfully',
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
    
    public function getUserProducts(Request $request, $id)
    {
        $products = Product::where('user_id', '=', $id)->get();

        return $products;
    }

    public function vegetable()
    {
        $products = Product::where('category', 'Like', 'Vegetable')->get();
        return response()->json([
            'status'=> 200,
            'products'=>$products,
        ]);
        
        
    }
    public function fruit()
    {
        $products = Product::where('category', 'Like', 'Fruit')->get();
        return response()->json([
            'status'=> 200,
            'products'=>$products,
        ]);
    }

    public function search($key)
    {
        return Product::where('name', 'Like', "%$key%")->get();
    }

    public function viewfruit($product_id)
    {
        $products = Product::find($id);
        $review = Review::where('product_id', $product_id)->get();
        return response()->json([
            'status'=> 200,
            'reviews' =>$review,
        ]);
    }

    public function viewvegetable($product_id)
    {
        $review = Review::where('product_id', $product_id)->get();
        return response()->json([
            'status'=> 200,
            'reviews' =>$review,
        ]);
    }

    public function recentSold($user_id)
    {
        $recent = Review::where('seller_id', $user_id)->orderBy('updated_at', 'desc')->get();
        return response()->json([
            'status'=>200,
            'reviews'=>$recent,
        ]);
    }
    
    
}