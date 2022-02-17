<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName,
            'key' => $this->faker->colorName,
            'hex' => $this->faker->hexColor,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
