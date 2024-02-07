<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            //
            'title' => '測試產品',
            'content' => $this->faker->word,
            'unit_name' => '個',
            'price' => $this->faker->numberBetween(100, 1000),
            'quantity' => $this->faker->numberBetween(10, 100)
        ];
    }

    public function less()
    {
        return $this->state(function (array $attributes) {
            return [
                'quantity' => 1
            ];
        });
    }
}
