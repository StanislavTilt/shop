<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use App\Models\Attribute;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'old_price' => $this->faker->optional(0.5)->randomNumber(4, true),
            'price' => $this->faker->randomNumber(3),
            'quantity' => $this->faker->numberBetween(1, 100),
            'brand_id' => Brand::all()->random()->id,
            'weight' => $this->faker->numberBetween(1, 100),
            'status' => Product::STATUS_ACTIVE,
        ];
    }

    public function configure(): ProductFactory
    {
        return $this->afterCreating(function (Product $product) {
            //$url = 'https://source.unsplash.com/600x600?clothes';
            $url = 'https://www.google.com/search?q=pics&rlz=1C1IXYC_ruUA942UA942&sxsrf=AOaemvK5Hq8hvqSO7QHvOLeicMHGoC0kyg:1640684612891&source=lnms&tbm=isch&sa=X&ved=2ahUKEwjCqai8mob1AhXFAxAIHXJABaUQ_AUoAXoECAEQAw&biw=2133&bih=1076&dpr=0.9';
            $product
                ->addMediaFromUrl($url)
                ->toMediaCollection('productImage');

            $sizeAttribute = Attribute::where('key', 'size')->get()->random();
            $colorAttribute = Attribute::where('key', 'color')->get()->random();

            $product->options()->attach($sizeAttribute->options, [
                'attribute_id' => $sizeAttribute->id,
                'quantity' => $this->faker->numberBetween(0, 100),
            ]);
            $product->options()->attach($colorAttribute->options, [
                'attribute_id' => $colorAttribute->id,
                'quantity' => $this->faker->numberBetween(0, 100),
            ]);
        });
    }
}

