<?php

namespace Tests\Feature\Controller;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CartItemControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */

    private $fakeUser;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->fakeUser = User::create([
            'email' => 'test@test.com',
            'name' => 'testing',
            'password' => 123456789
        ]);
        Passport::actingAs($this->fakeUser);
    }

    public function testStore()
    {
//        $cart = $this->fakeUser->carts()->create();
        $cart = Cart::factory()->create();
        $product = Product::factory()->create();
//        $product = Product::create([
//            'title' => 'test Product',
//            'content' => 'cool',
//            'price' => 10,
//            'quantity' => 10
//        ]);
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 2]
        );
        $response->assertOk();

        $product = Product::factory()->less()->create();
//        $product = Product::create([
//            'title' => 'test Product',
//            'content' => 'cool',
//            'price' => 10,
//            'quantity' => 10
//        ]);
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 10]
        );

        $this->assertEquals($product->title.' 數量不足', $response->getContent());

        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 9999]
        );
//        dd($response,$product);
        $response->assertStatus(400);
    }

    public function testUpdate()
    {
//        $cart = $this->fakeUser->carts()->create();
        $cart = Cart::factory()->create([
            'user_id' => $this->fakeUser->id
        ]);
        $product = Product::factory()->create();
//        $product = Product::create([
//            'title' => 'test Product',
//            'content' => 'cool',
//            'price' => 10,
//            'quantity' => 10
//        ]);
//        $cartItem = $cart->cartItems()->create([
//            'product_id' => $product->id,
//            'quantity' => 10,
//        ]);
        $cartItem = CartItem::factory()->create();
        $response = $this->call(
            'PUT',
            'cart-items/' . $cartItem->id,
            ['quantity' => 1]
        );
        $this->assertEquals('true', $response->getContent());

        $cartItem->refresh();

        $this->assertEquals(1, $cartItem->quantity);
    }

    public function testDestroy()
    {
//        $cart = $this->fakeUser->carts()->create();
        $cart = Cart::factory()->create([
            'user_id' => $this->fakeUser->id
        ]);
        $product = Product::factory()->create();
//        $product = Product::create([
//            'title' => 'test Product',
//            'content' => 'cool',
//            'price' => 10,
//            'quantity' => 10
//        ]);
//        $cartItem = $cart->cartItems()->create([
//            'product_id' => $product->id,
//            'quantity' => 10,
//        ]);
        $cartItem = CartItem::factory()->create();
        $response = $this->call(
            'DELETE',
            'cart-items/' . $cartItem->id
        );
        $response->assertOk();
        $cartItem = CartItem::find($cartItem->id);
        $this->assertNull($cartItem);

    }
}