<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class CartService
{
    const VIP_LEVEL = 2;
    const VIP_RATE = 0.8;
    const MORMAL_RATE = 1;

    public function checkout($cart)
    {
        DB::beginTransaction();
        try {
            $lackCartItem = $this->checkLackCartItem($cart->cartItems);
            if ($lackCartItem) return $lackCartItem->product->title . '數量不足';
            $rate = $this->cartRate($cart);
            $order = $this->createOrder($cart, $rate);
            $cart->update(['checkouted' => true]);
            $order->orderItems;
            DB::commit();
            return $order;
        } catch (\Exception $exception) {
            DB::rollBack();
            return 'something error';
        }
    }

    public function checkLackCartItem($cartItems)
    {
        return $cartItems->filter(function ($cartItem) {
            return $cartItem->product->quantity < $cartItem->quantity;
        })->first();
    }

    public function cartRate($cart)
    {
        return $cart->user->level == self::VIP_LEVEL ? self::VIP_RATE : self::MORMAL_RATE;
    }

    public function createOrder($cart, $rate)
    {
        $order = $cart->order()->create([
            'user_id' => $cart->user_id,
        ]);

        foreach ($cart->cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price * $cartItem->quantity * $rate
            ]);
            $cartItem->product->update(['quantity' => $cartItem->product->quantity - $cartItem->quantity]);
        }
        return $order;
    }
}
