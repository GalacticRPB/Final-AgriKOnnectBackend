<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    function register(Request $req)
    {
        $user = new User;
        $user->firstname=$req->input('firstname');
        $user->middlename=$req->input('middlename');
        $user->lastname=$req->input('lastname');
        $user->birthdate=$req->input('birthdate');
        $user->gender=$req->input('gender');
        $user->username=$req->input('username');
        $user->mobilephone=$req->input('mobilephone');
        $user->email=$req->input('email');
        $user->orgName=$req->input('orgName');
        $user->brgy=$req->input('brgy');
        $user->password=Hash::make($req->input('password'));
        $user->save();
        return $user->toJson();
    }

    //
    function login(Request $req)
    {
        $user= User::where('username',$req->username)->first();
        if(!$user || !Hash::check($req->password, $user->password))
        {
            return ["error"=> "Email or password is incorrect"];
        }
        return $user;
    }

    public function edit($id)
    {
        $user = User::find($id);
        if($user)
        {
            return response()->json([
                'status'=> 200,
                'user' => $user,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No User ID Found',
            ]);
        }

    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
            'firstname'=>'required',
            'middlename'=>'required',
            'lastname'=>'required',
            'birthdate'=>'required',
            'gender'=>'required',
            'username'=>'required',
            'mobilephone'=>'required|max:11',
            'email'=>'required',
            'orgName'=>'required',
            'brgy'=>'required',
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
            $user = User::find($id);
            if($user)
            {
                $user->firstname=$req->input('firstname');
                $user->middlename=$req->input('middlename');
                $user->lastname=$req->input('lastname');
                $user->birthdate=$req->input('birthdate');
                $user->gender=$req->input('gender');
                $user->username=$req->input('username');
                $user->mobilephone=$req->input('mobilephone');
                $user->email=$req->input('email');
                $user->orgName=$req->input('orgName');
                $user->brgy=$req->input('brgy');
                $user->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'User Account Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No User ID Found',
                ]);
            }
        }
    }

    public function editPassword($id)
    {
        $user = User::find($id);
        if($user)
        {
            return response()->json([
                'status'=> 200,
                'user' => $user,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No User ID Found',
            ]);
        }

    }

    public function updatePassword(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
            'password'=>'null|min:8',
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
            $user = User::find($id);
            if($user)
            {
                $user->password=Hash::make($req->input('password'));
                $user->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'User Account Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No User ID Found',
                ]);
            }
        }
    }

    public function getUserInfo(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->get();

        return $user;
    }
}
