<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AdminProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AdminProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()
            ->count(3)
            ->has(AdminProduct::factory()
                ->count(3))
            ->create();
    }
}
