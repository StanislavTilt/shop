<?php

namespace Database\Seeders;

use App\Enums\PushMessageTemplateTypesEnum;
use App\Models\PushMessageTemplate;
use App\Models\PushMessageType;
use Illuminate\Database\Seeder;

class PushMessageTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PushMessageType::insert([
            [
                'key' => PushMessageTemplateTypesEnum::NEW_PROMOTION,
                'name' => 'Новая акция'
            ],
            [
                'key' => PushMessageTemplateTypesEnum::ORDER_CHANGE_STATUS,
                'name' => 'Изменение статуса заказа'
            ],
            [
                'key' => PushMessageTemplateTypesEnum::ORDER_HISTORY,
                'name' => 'что то история заказов'
            ],
            [
                'key' => PushMessageTemplateTypesEnum::CART,
                'name' => 'что то корзина'
            ],
            [
                'key' => PushMessageTemplateTypesEnum::CURRENT_PRODUCT,
                'name' => 'что то конкретный продукт'
            ],
            [
                'key' => PushMessageTemplateTypesEnum::PRODUCTS_BY_STOREFRONT,
                'name' => 'продукты витрины'
            ],
            [
                'key' => PushMessageTemplateTypesEnum::PRODUCTS_BY_BRAND,
                'name' => 'продукты бренда'
            ],
            [
                'key' => PushMessageTemplateTypesEnum::PRODUCTS_BY_CATEGORY,
                'name' => 'продукты категории'
            ],
        ]);
        PushMessageTemplate::insert([
            [
                'title' => 'Новая акция!',
                'body' => 'С fromDate по toDate на все categories бренда brands скидка percent%!',
                'type_id' => 1,
                'changeable' => 0,
                'replaceable_keys' => json_encode(['fromDate', 'toDate', 'categories', 'brands', 'percent']),
            ],
            [
                'title' => 'статус заказа изменен',
                'body' => 'Новый статус заказа № id: status.',
                'type_id' => 2,
                'changeable' => 0,
                'replaceable_keys' => json_encode(['id', 'status']),
            ],
            [
                'title' => 'история заказов',
                'body' => 'ура история заказов',
                'type_id' => 3,
                'changeable' => 1,
                'replaceable_keys' => null,
            ],
            [
                'title' => 'корзина',
                'body' => 'ура корзина',
                'type_id' => 4,
                'changeable' => 1,
                'replaceable_keys' => null,
            ],
            [
                'title' => 'определеный опродукт',
                'body' => 'ура определеный опродукт',
                'type_id' => 5,
                'changeable' => 1,
                'replaceable_keys' => null,
            ],
            [
                'title' => 'определенная витрина',
                'body' => 'ура определенная витрина',
                'type_id' => 6,
                'changeable' => 1,
                'replaceable_keys' => null,
            ],
            [
                'title' => 'определенный бренд',
                'body' => 'ура определенный бренд',
                'type_id' => 7,
                'changeable' => 1,
                'replaceable_keys' => null,
            ],
            [
                'title' => 'определенный категория',
                'body' => 'ура определенный категория',
                'type_id' => 8,
                'changeable' => 1,
                'replaceable_keys' => null,
            ],
        ]);
    }
}
