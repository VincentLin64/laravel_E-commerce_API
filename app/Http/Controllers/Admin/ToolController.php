<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateProductPrice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ToolController extends Controller
{
    //
    public function updateProductPrice(){
        $vProduct = Product::all();
        foreach ($vProduct as $product){
//            UpdateProductPrice::dispatch($product);
            UpdateProductPrice::dispatch($product)->onQueue('tool');
        }
    }

    public function createProductRedis(){
        Redis::set('products', json_encode(Product::all()));
    }
}
