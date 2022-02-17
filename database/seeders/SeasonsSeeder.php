<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Seeder;

class SeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::insert([
            [
                'name' => 'Зима'
            ],
            [
                'name' => 'Весна'
            ],
            [
                'name' => 'Лето'
            ],
            [
                'name' => 'Осень'
            ],
        ]);
    }
}
