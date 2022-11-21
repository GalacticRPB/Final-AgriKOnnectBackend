<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CheckoutController;
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
Route::get('users', [UserController::class, 'index']);
Route::get('users2', [UserController::class, 'index2']);
Route::get('/edit-verification/{id}', [UserController::class, 'editVerification']);
Route::put('/update-verification/{id}', [UserController::class, 'verification']);
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('/edit/{id}', [UserController::class, 'edit']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::get('user/{id}',  [UserController::class, 'getUserInfo']);
Route::get('/editPassword/{id}', [UserController::class, 'editPassword']);
Route::put('/updatePassword/{id}', [UserController::class, 'updatePassword']);
Route::get('/editPassword/{id}', [UserController::class, 'editPassword']);
Route::get('/editImage/{id}', [UserController::class, 'editImage']);
Route::put('/updateImage/{id}', [UserController::class, 'updateImage']);

//customer
Route::post('registerCustomer', [CustomerController::class, 'registerCustomer']);
Route::post('loginCustomer', [CustomerController::class, 'loginCustomer']);
Route::get('/editCustomer/{id}', [CustomerController::class, 'editCustomer']);
Route::put('/updateCustomer/{id}', [CustomerController::class, 'updateCustomer']);
Route::post('/addtoCart', [CartController::class, 'addtoCart']);
Route::get('/basket/{id}', [CartController::class, 'viewbasket']);
Route::put('basket-updatedquantity/{cart_id}/{scope}/{id}', [CartController::class, 'updatequantity']);
Route::get('checkout/{id}',[CartController::class, 'checkoutDetails']);

Route::post('place-order', [CheckoutController::class, 'placeorder']);

//Route::get('list', [ProductController::class, 'list']);
Route::get('products/{user_id}', [ProductController::class, 'getUserProducts']);
Route::resource('products', ProductController::class);
Route::get('/vegetable', [ProductController::class, 'vegetable']);
Route::get('/fruit',[ProductController::class, 'fruit']);
Route::get('/search/{key}', [ProductController::class, 'search']);
Route::get('viewfruit/{id}',[ProductController::class, 'viewfruit']);
Route::get('viewvegetable/{id}',[ProductController::class, 'viewvegetable']);

