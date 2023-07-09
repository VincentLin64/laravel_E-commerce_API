<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vUser = auth()->user();
        $vCart = Cart::with('cartItems')
            ->where('user_id', $vUser->id)
            ->where('checkouted', false)
            ->firstOrCreate(['user_id' => $vUser->id]);
        return response($vCart);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkout() {
        $vUser = auth()->user();
        $vCart = $vUser->carts()->where('checkouted', false)->with('cartItems')->first();
        if ($vCart){
            $result = $vCart->checkout();
            return response($result);
        }else{
            return response('沒有購物車', 400);
        }
    }
}
