<?php

namespace Database\Factories;

use App\Models\AdminProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminProductFactory extends Factory
{

    protected $model = AdminProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productCount = Product::all()->count();
        return [
            'product_id' => rand(1,$productCount),
        ];
    }
}
