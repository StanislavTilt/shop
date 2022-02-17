<?php

namespace Database\Factories;

use App\Models\Order;
use App\ValueObjects\Order\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{

    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_type' => rand(0,1),
            'delivery_type' => rand(0,1),
            'delivery_address' => $this->faker->address,
            'delivery_point_id' => $this->faker->iban,
            'status' => array_rand(OrderStatus::all()),
            'payment_time' => now(),
            'delivery_date' => now()->addWeek(),
            'created_at' => now()
        ];
    }
}
