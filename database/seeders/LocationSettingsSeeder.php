<?php

namespace Database\Seeders;

use App\Models\CurrencyCost;
use App\Models\LocationSetting;
use Illuminate\Database\Seeder;

class LocationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LocationSetting::insert([
            [
                'location_id' => 1,
                'kilogram_price' => 19,
                'allowance' => 17,
            ],
            [
                'location_id' => 2,
                'kilogram_price' => 18,
                'allowance' => 22,
            ],
        ]);

        CurrencyCost::insert([
            [
                'location_id' => 1,
                'value' => 89,
            ],
            [
                'location_id' => 2,
                'value' => 75,
            ]
        ]);
    }
}
