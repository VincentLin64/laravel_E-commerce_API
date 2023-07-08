<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $vInput = $request->all();
        $vRule = [
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer'
        ];
        $messages = [
            'required' => ':attribute 是必填',
            'integer' => ':attribute 需填數字'
        ];

        $oValidator = Validator::make($vInput, $vRule, $messages);
        if ($oValidator->fails()) {
            return response($oValidator->errors(), 400);
        }
        $validateData = $oValidator->validate();
        DB::table('cart_items')->insert([
            'cart_id' => $validateData['cart_id'],
            'product_id' => $validateData['product_id'],
            'quantity' => $validateData['quantity'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(true);
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
        $vInput = $request->all();
        DB::table('cart_items')
            ->where('id', $id)
            ->update(
                [
                    'quantity' => $vInput['quantity'],
                    'updated_at' => now(),
                ]
            );
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('cart_items')
            ->where('id', $id)
            ->delete();
        return response()->json(true);
    }
}
