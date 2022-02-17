<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->count(3)
            ->has(Product::factory()
                ->has(Brand::factory())
                ->count(20)
            )
            ->has(Category::factory()
                ->count(5),
                'children'
            )
            ->create();
    }
}
