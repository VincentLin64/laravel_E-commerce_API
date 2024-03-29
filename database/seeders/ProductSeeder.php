<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::upsert(
            [
                ['id' => '1', 'title' => '固定資料', 'content' => '固定內容', 'unit_name' => '個', 'price' => rand(0, 200), 'quantity' => rand(1, 50)],
                ['id' => '2', 'title' => '固定資料', 'content' => '固定內容', 'unit_name' => '個', 'price' => rand(0, 200), 'quantity' => rand(1, 50)]
            ],
            ['id'],
            ['price', 'quantity']
        );
    }
}
