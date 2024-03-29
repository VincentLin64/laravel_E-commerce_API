<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;
//    protected $fillable = [
//        'cart_id',
//        'product_id',
//        'quantity',
//    ];
    protected $guarded = [
        ''
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $appends = [
      'current_price'
    ];

    public function getCurrentPriceAttribute() {
        return $this->quantity * $this->product->price;
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
