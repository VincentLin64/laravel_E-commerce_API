<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(Request $request) {

        $iPage = $request->input('page',1);
        $productCounts = Product::count();
        $dataPerPage = 2;
        $productPages = ceil($productCounts / $dataPerPage) + 1;
        $vProducts = Product::orderBy('created_at', 'desc')
            ->offset($dataPerPage * ($iPage - 1))
            ->limit($dataPerPage)
            ->get();

        $vReturnData = ['products' => $vProducts, 'productCount'=> $productCounts, 'productPages' => $productPages];
        return view('admin.products.index', $vReturnData);
    }

    public function uploadImage(Request $request){
        $vFile = $request->file('product_image');
        $productId = $request->input('product_id');
        if (!$productId){
            return redirect()->back()->withErrors(['msg'=>'參數錯誤']);
        }
        $product = Product::find($productId);
        $path = $vFile->store('public/images');
//        $path = $vFile->store('images');
        $product->images()->create([
            'filename' => $vFile->getClientOriginalName(),
            'path' => $path
        ]);
        return redirect()->back();

    }
}
