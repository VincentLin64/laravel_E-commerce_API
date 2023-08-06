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
Route::post('read-notification', 'WebController@readNotification');

// products
Route::group(['middleware' => 'check_dirty'], function () {
    Route::resource('/products', 'ProductController');
});
Route::post('/products/check-product', 'ProductController@checkProduct');
Route::get('/products/{id}/shared-url', 'ProductController@shareUrl');

// admin
Route::group(['prefix'=>'admin', 'namespace'=>'Admin'], function() {
    // admin/products
    Route::group(['prefix'=>'products'], function(){
        Route::get('/', 'ProductController@index');
        Route::post('/upload-image', 'ProductController@uploadImage');
        Route::post('/excel/import', 'ProductController@importExcel');
    });
    // admin/orders
    Route::group(['prefix'=>'orders'], function(){
        Route::get('/', 'OrderController@index');
        Route::post('/{id}/delivery', 'OrderController@delivery');
        Route::get('/excel/export', 'OrderController@export');
        Route::get('/excel/export-by-shipped', 'OrderController@exportByShipped');

    });

    // admin/tools
    Route::group(['prefix'=>'tools'], function(){
        Route::post('/update-product-price', 'ToolController@updateProductPrice');
        Route::post('/create-product-redis', 'ToolController@createProductRedis');
    });

});

// auth
Route::post('/signup', 'AuthController@signup');
Route::post('/login', 'AuthController@login');
Route::group(['middleware' => 'auth:api'], function (){
    Route::get('/user','AuthController@user');
    Route::get('/logout', 'AuthController@logout');

    Route::resource('/carts', 'CartController');
    Route::resource('/cart-items', 'CartItemController');
    Route::post('/carts/checkout', 'CartController@checkout');
});


