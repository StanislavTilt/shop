<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(3)
            ->has(Order::factory()
                ->has(OrderProduct::factory()
                    ->count(3))
                ->count(3)
            )
            ->create();
    }
}
