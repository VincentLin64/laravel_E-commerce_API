<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
//        'cart_id',
//        'product_id',
//        'quantity',
    ];
    protected $guarded = [
        'quantity'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $appends = [
      'current_price'
    ];

    public function getCurrentPriceAttribute() {
        return $this->quantity * 10;
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
