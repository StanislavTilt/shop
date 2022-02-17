<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    private static $order = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'icon' => $this->faker->imageUrl(120, 120, 'clothes', true, 'vector'),
            'order' => self::$order++,
            'is_active' => true
        ];
    }
}
