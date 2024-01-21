<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// auth - 註冊
Route::post('/signup', 'AuthController@signup');
// api - 登入
// product - 取得產品
Route::get('/products', 'ProductController@index');
Route::post('/login', 'AuthController@login');
Route::group(['middleware' => 'auth:api'], function () {
    // api - 登出
    Route::get('/logout', 'AuthController@logout');
    // api - 確認使用者
    Route::get('/user', 'AuthController@user');
    // api - 產品加入我的最愛
    Route::post('productFavorite', 'ProductController@favoriteProduct');

    // carts
    Route::resource('/carts', 'CartController');
    Route::post('/carts/checkout', 'CartController@checkout');
    // carts-items
    Route::resource('/cart-items', 'CartItemController');


    // admin
    Route::group(['prefix' => 'admin', 'middleware' => ['checkAdmin']], function () {
        // admin/product
        Route::apiResource('/products', 'ProductController');
        Route::group(['namespace' => 'Admin'], function () {
            // admin/orders
            Route::group(['prefix' => 'orders'], function () {
                // api
                Route::post('/{id}/delivery', 'OrderController@delivery');
            });
            // admin/tools
            Route::group(['prefix' => 'tools'], function () {
                Route::post('/update-product-price', 'ToolController@updateProductPrice');
                Route::post('/create-product-redis', 'ToolController@createProductRedis');
            });
        });

    });
});


