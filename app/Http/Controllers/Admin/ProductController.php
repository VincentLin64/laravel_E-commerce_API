<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    //
    public function index(Request $request) {

        $iPage = $request->input('page',1);
        $productCounts = Product::count();
        $dataPerPage = 2;
        $productPages = ceil($productCounts / $dataPerPage) + 1;
        $vProducts = Product::orderBy('created_at', 'desc')
            ->paginate(5);

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
    public function importExcel(Request $request){
        $file = $request->file('excel');
        Excel::import(new ProductImport(), $file);

        return redirect()->back();
    }
}
