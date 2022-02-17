<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeOption;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizeAttribute = Attribute::create([
            'name' => 'Размеры',
            'type' => Attribute::TYPE_MULTISELECT,
            'key' => 'size',
            'sort_order' => 0,
        ]);

        $colorAttribute = Attribute::create([
            'name' => 'Цвет',
            'type' => Attribute::TYPE_MULTISELECT,
            'key' => 'color',
            'sort_order' => 1,
        ]);

        AttributeOption::insert([
            [
                'name' => 'XS',
                'key' => 'XS',
                'attribute_id' => $sizeAttribute->id
            ],
            [
                'name' => 'S',
                'key' => 'S',
                'attribute_id' => $sizeAttribute->id
            ],
            [
                'name' => 'M',
                'key' => 'M',
                'attribute_id' => $sizeAttribute->id
            ],
            [
                'name' => 'L',
                'key' => 'L',
                'attribute_id' => $sizeAttribute->id
            ],
            [
                'name' => 'XL',
                'key' => 'XL',
                'attribute_id' => $sizeAttribute->id
            ]
        ]);

        AttributeOption::insert([
            [
                'name' => 'Белый',
                'value' => '#ffffff',
                'key' => 'white',
                'attribute_id' => $colorAttribute->id
            ],
            [
                'name' => 'Морской',
                'value' => '#43F2E8',
                'key' => 'sea',
                'attribute_id' => $colorAttribute->id
            ],
            [
                'name' => 'Бежевый',
                'value' => '#FFF4F2',
                'key' => 'beige',
                'attribute_id' => $colorAttribute->id
            ],
        ]);
    }
}
