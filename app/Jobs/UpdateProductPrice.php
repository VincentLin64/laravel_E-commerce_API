<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateProductPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $product;
    public function __construct($product)
    {
        //
        $this->product = $product;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        sleep(5);
        $this->product->update(['price'=>$this->product->price * random_int(2,10)]);
    }
}
