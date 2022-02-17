<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Storefront;

class StorefrontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storefront::insert([
            [
                'title' => 'Новинки',
                'key' => 'new_items',
                'cover' => 'https://source.unsplash.com/600x600?clothes,shoes',
                'parameters' => json_encode([
                    [
                        'name' => 'Время жизни товаров (в днях)',
                        'key' => 'products_lifetime',
                        'value' => 7
                    ]
                ])
            ],
        ]);
    }
}
