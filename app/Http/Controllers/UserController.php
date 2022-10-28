<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $user->address=$req->input('address');
        $user->province=$req->input('province');
        $user->region=$req->input('region');
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
}
