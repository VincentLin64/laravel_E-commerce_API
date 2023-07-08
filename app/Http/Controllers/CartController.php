<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cart = DB::table('carts')->get()->first();
        if (empty($cart)) {
            DB::table('carts')->insert(['created_at' => now(), 'updated_at' => now()]);
            $cart = DB::table('carts')->get()->first();
        }
        $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();
        $cart = collect($cart);
        $cart['item'] = collect($cartItems);
        return response($cart);
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
}
