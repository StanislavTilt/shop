<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

/**
 * Class PromotionSeeder
 * @package Database\Seeders
 */
class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promotion::factory()
            ->count(6)
            ->hasAttached(Brand::factory())
            ->hasAttached(Category::factory())
            ->hasAttached(Product::factory())
            ->create();
    }
}
