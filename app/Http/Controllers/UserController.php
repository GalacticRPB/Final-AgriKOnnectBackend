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
        $user->username=$req->input('username');
        $user->email=$req->input('email');
        $user->password=Hash::make($req->input('password'));
        $user->save();
        return $user;
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
