<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{

    protected $model = OrderProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productCount = Product::all()->count();
        return [
            'quantity' => rand(1,20),
            'price' => rand(1,10000),
            'product_id' => rand(1,$productCount)
        ];
    }
}
