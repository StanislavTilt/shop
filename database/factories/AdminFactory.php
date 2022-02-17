<?php

namespace Database\Factories;

use App\Enums\UserTypesEnum;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{

    protected $model = Admin::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'nickname' => $this->faker->userName,
            'phone' => $this->faker->phoneNumber,
            'role' => UserTypesEnum::ADMIN_USER,
            'email' => $this->faker->email,
            'status' => rand(0,1),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'product_create_count' => rand(0,10),
            'avatar' => '12312.png',
        ];
    }
}
