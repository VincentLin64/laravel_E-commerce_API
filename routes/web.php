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
//    return view('welcome');
//});
Route::get('/', 'WebController@index');
Route::get('/contact_us', 'WebController@contactUs');

// auth
Route::view('/loginPage', 'web.loginPage');
// web - 登入
Route::post('/login', 'AuthController@login');
Route::group(['middleware' => 'auth'], function () {
    // web登出
    Route::get('/logout', 'AuthController@logout');
    // 已讀
    Route::post('read-notification', 'WebController@readNotification');
});

// products
Route::group(['prefix' => 'products'], function () {
    Route::post('/check-product', 'ProductController@checkProduct');
    Route::get('/{id}/shared-url', 'ProductController@shareUrl');
    Route::get('/{product_id}', 'ProductController@productDetail');
});



// admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['checkAdmin', 'auth']], function () {
    // admin/orders
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', 'OrderController@index');
        Route::get('/datatable', 'OrderController@datatable');
        Route::get('/{order_id}', 'OrderController@index');
        Route::get('/excel/export', 'OrderController@export');
        Route::get('{order_id}/excel/export', 'OrderController@export');
        Route::get('/excel/export-by-shipped', 'OrderController@exportByShipped');
    });
    // admin/products
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@index');
        Route::post('/upload-image', 'ProductController@uploadImage');
        Route::post('/excel/import', 'ProductController@importExcel');
    });
});




