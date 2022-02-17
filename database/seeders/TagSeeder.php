<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::insert([
            [
                'title' => 'Акция',
                'key' => 'stock',
                'order' => 0
            ],
            [
                'title' => 'Скидка',
                'key' => 'discount',
                'order' => 1
            ],
            [
                'title' => 'Хит',
                'key' => 'hit',
                'order' => 2
            ],
            [
                'title' => 'Заканчивается',
                'key' => 'stockout',
                'order' => 3
            ],
            [
                'title' => 'Уже в России',
                'key' => 'already-in-russia',
                'order' => 3
            ]
        ]);
    }
}
