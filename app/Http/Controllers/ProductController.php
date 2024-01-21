<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Http\Services\ShortUrlService;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function __construct(ShortUrlService $shortUrlService, AuthService $authService)
    {
        $this->shortUrlService = $shortUrlService;
        $this->authservice = $authService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // NoDB
//        $data = $this->getData();
//        return response($data);

//        $data = DB::table('products')->get();
        $data = json_decode(Redis::get('products'));
        return response($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $vInputData = $request->all();
        $vInsertProduct = Product::create($vInputData);
        $this->setProductRedis();
//        $vGetOriginData = $this->getData();
//        $vGetOriginData->push(collect($vInputData));
//        return $vGetOriginData;
        return $vInsertProduct;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::findOrFail($id);
        $vInput = $request->all();
        $product->title = $vInput['title'] ?? $product->title;
        $product->content = $vInput['content'] ?? $product->content;
        $product->price = $vInput['price'] ?? $product->price;
        $product->quantity = $vInput['quantity'] ?? $product->quantity;
        $product->unit_name = $vInput['unit_name'] ?? $product->unit_name;
        $product->update();
        $this->setProductRedis();
        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        $this->setProductRedis();
        return response(true, 204);
    }

    public function getData()
    {
        return collect([
            collect(['id' => 0, 'title' => '測試商品1', 'content' => '棒', 'price' => 50]),
            collect(['id' => 1, 'title' => '測試商品2', 'content' => '讚', 'price' => 55]),
        ]);
    }

    public function checkProduct(Request $request)
    {
        $vInput = $request->input('product_id');
        $vProduct = Product::find($vInput);
        if ($vProduct->quantity > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function shareUrl($id)
    {
        $this->authservice->fakeReturn();
        $url = $this->shortUrlService->makeShortUrl("http://127.0.0.1:2080/products/$id");
        return response(['url' => $url]);
    }

    public function productDetail($id)
    {
        $vProduct = Product::findOrFail($id);
        $vNotifications = $this->getNotification();
        return view('web.productDetail', ['product' => $vProduct, 'notifications' => $vNotifications]);
    }

    private function setProductRedis()
    {
        Redis::set('products', json_encode(Product::all()));
    }


    public function getNotification()
    {
        $user = Auth::user();
        return $user->notifications ?? [];
    }

    public function favoriteProduct(Request $request)
    {

        $user = Auth::user();
        $vRequest = $request->all();
        $product = Product::findOrFail($vRequest['product_id']);

        try {
            $user->favorite_products()->attach($product);
        } catch (\Illuminate\Database\QueryException $e) {
            return response(['result' => '已加入過此商品'], 202);
        }

        return response(['result' => '商品名稱：' . $product->title . ' 已放入我的最愛'], 200);
    }
}
