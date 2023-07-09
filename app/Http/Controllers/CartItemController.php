<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;

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
        $vValidData = $oValidator->validate();

        $vProduct = Product::find($vValidData['product_id']);
        if (!$vProduct->checkQuantity($vValidData['quantity'])){
            return response($vProduct->title.' 數量不足', 400);
        }

        $vCart = Cart::find($vValidData['cart_id']);
        $vResult = $vCart->cartItems()->create([
            'product_id' => $vProduct->id,
            'quantity' => $vValidData['quantity']
        ]);
        return response()->json($vResult);
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
    public function update(UpdateCartItem $request, string $id)
    {
        $vInput = $request->validated();
        $vItem = CartItem::find($id);
        // 先填上不儲存(fill=>save)
        // $item->fill(['quantity'=> $vInput['quantity']]);
        // $item->save();
        $vItem->update(['quantity'=> $vInput['quantity']]);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vItem = CartItem::find($id)->delete();
        // 撈出軟刪除的資料並強制刪除
        // $vItem = CartItem::withoutTrashed()->find($id)->forceDelete();
        return response()->json(true);
    }
}
