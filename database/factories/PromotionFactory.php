<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PromotionFactory extends Factory
{
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'percent' => $this->faker->randomNumber(2),
            'from_date' => now(),
            'to_date' => now()->addDays(7),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
