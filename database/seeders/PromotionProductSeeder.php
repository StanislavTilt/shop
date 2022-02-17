<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Promotion;
use App\Models\PromotionProduct;
use Illuminate\Database\Seeder;

class PromotionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = Promotion::all();

        $products = Product::all();

        $lastId = 0;
        $promotionInsert = [];
        foreach ($promotions as $promotion) {
            foreach ($products->where('id', '>', $lastId) as $product) {
                $promotionInsert[] = [
                    'promotion_id' => $promotion->id,
                    'product_id' => $product->id,
                ];
                $lastId = $product->id;
            }
        }

        PromotionProduct::insert($promotionInsert);
    }
}
