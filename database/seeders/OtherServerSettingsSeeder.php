<?php

namespace Database\Seeders;

use App\Models\OtherServerSetting;
use Illuminate\Database\Seeder;

class OtherServerSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OtherServerSetting::insert([
            [
                'name' => 'Время удаления архивных продуктов в днях',
                'key' => 'archive_removal_days',
                'value' => '90',
            ],
            [
                'name' => 'Время жизни кода подтверждения в секундах',
                'key' => 'validation_request_lifetime',
                'value' => '60',
            ],
            [
                'name' => 'Комиссия за конвертацию валюты в процентах',
                'key' => 'currency_conversion_commission',
                'value' => '0.04',
            ],
        ]);
    }
}
