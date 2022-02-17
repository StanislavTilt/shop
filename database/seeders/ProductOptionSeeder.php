<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Database\Seeder;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $productsOption = [];
        $colorsCount = Color::all()->count();
        foreach ($products as $product)
        {
            $productsOption[] = [
                'color_id' => rand(1,$colorsCount),
                'product_id' => $product->id,
                'size' => 'EU '.rand(35,44),
                'quantity' => rand(1,20),
            ];
            $productsOption[] = [
                'color_id' => rand(1,$colorsCount),
                'product_id' => $product->id,
                'size' => 'EU '.rand(35,44),
                'quantity' => rand(1,20),
            ];
        }
        ProductOption::insert($productsOption);
    }
}
