<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//seller

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('/edit/{id}', [UserController::class, 'edit']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::get('/editPassword/{id}', [UserController::class, 'edit']);
Route::put('/updatePassword/{id}', [UserController::class, 'updatePassword']);

//customer
Route::post('registerCustomer', [CustomerController::class, 'registerCustomer']);
Route::post('loginCustomer', [CustomerController::class, 'loginCustomer']);
Route::get('/editCustomer/{id}', [CustomerController::class, 'editCustomer']);
Route::put('/updateCustomer/{id}', [CustomerController::class, 'updateCustomer']);
Route::get('/editCustomerPassword/{id}', [CustomerController::class, 'edit']);
Route::put('/updateCustomerPassword/{id}', [CustomerController::class, 'updateCustomerPassword']);

//Route::get('list', [ProductController::class, 'list']);
Route::get('products/{user_id}', [ProductController::class, 'getUserProducts']);
Route::resource('products', ProductController::class);
