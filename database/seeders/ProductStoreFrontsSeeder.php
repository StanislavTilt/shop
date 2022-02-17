<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductStorefront;
use Illuminate\Database\Seeder;

class ProductStoreFrontsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $storefrontsInsert = [];
        foreach ($products as $product)
        {
            $storefrontsInsert[] = [
                'product_id' => $product->id,
                'storefront_id' => 1,
                'expired_at' => now()->addWeek()
            ];
        }
        ProductStorefront::insert($storefrontsInsert);
    }
}
