<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('web.index');
//});
Route::get('/', 'WebController@index');
Route::get('/contact_us', 'WebController@contactUs');

Route::group(['middleware' => 'check_dirty'], function () {
    Route::resource('/products', 'ProductController');
});
Route::post('/products/check-product', 'ProductController@checkProduct');
Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function() {
    Route::get('/orders/', 'OrderController@index');
});


Route::post('/signup', 'AuthController@signup');
Route::post('/login', 'AuthController@login');
Route::group(['middleware' => 'auth:api'], function (){
    Route::get('/user','AuthController@user');
    Route::get('/logout', 'AuthController@logout');

    Route::resource('/carts', 'CartController');
    Route::resource('/cart-items', 'CartItemController');
    Route::post('/carts/checkout', 'CartController@checkout');
});


