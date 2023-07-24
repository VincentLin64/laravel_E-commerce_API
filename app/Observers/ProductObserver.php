<?php

namespace App\Observers;

use App\Models\product;
use App\Notifications\ProductReplenish;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     */
    public function created(product $product): void
    {
        //
    }

    /**
     * Handle the product "updated" event.
     */
    public function updated(product $product): void
    {
        //
        $vChanges = $product->getChanges();
        $vOriginal = $product->getOriginal();
        if (isset($vChanges['quantity']) && $product->quantity > 0 && $vOriginal['quantity'] == 0){
            foreach ($product->favorite_users as $user){
                $user->notify(new ProductReplenish($product));
            }
        }
    }

    /**
     * Handle the product "deleted" event.
     */
    public function deleted(product $product): void
    {
        //
    }

    /**
     * Handle the product "restored" event.
     */
    public function restored(product $product): void
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     */
    public function forceDeleted(product $product): void
    {
        //
    }
}
