- [Список продуктов](#products)
- [Фильтрация продуктов](#filters-for-products)
- [Получения продукта по ID](#get-product-by-id)
- [Получение доступных фильтров](#get-aviable-filters)

<a name="products"></a>
## Список продуктов

### `POST` **Конечная точка**

## Сортировка

|Имя параметра|Пример|Описание|
|:-|:-|:-|
|sort_key|`nullable|string`|Ключ сортировки
|sort_method|`nullable|string`|Метод сортировки

```text
/products
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "data": [
        {
            "id": 1,
            "name": "Mr. Niko Schultz",
            "description": "Impedit quod praesentium velit. Id vero assumenda dolor. Et consequuntur numquam consequatur aut natus ipsum. Et quo illo veniam aut dolor.",
            "old_price": null,
            "price": "167.00",
            "quantity": 38,
            "tags": [
                {
                    "id": 1,
                    "title": "Акция",
                    "key": "stock",
                    "sort": null
                }
            ]
        },
        {
            "id": 2,
            "name": "Citlalli Monahan Jr.",
            "description": "Cum porro esse pariatur. Consequatur atque dolore ipsum similique officiis. Sit facilis illo aut sit esse id. Veniam ut inventore delectus.",
            "old_price": "900.00",
            "price": "805.00",
            "quantity": 71,
            "tags": [
                {
                    "id": 2,
                    "title": "Скидка",
                    "key": "discount",
                    "sort": null
                }
            ]
        }
    ],
    "links": {
        "first": "http:\/\/localhost\/api\/products?page=1",
        "last": "http:\/\/localhost\/api\/products?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Назад",
                "active": false
            },
            {
                "url": "http:\/\/localhost\/api\/products?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Вперёд &raquo;",
                "active": false
            }
        ],
        "path": "http:\/\/localhost\/api\/products",
        "per_page": 20,
        "to": 20,
        "total": 20
    }
}
```

<a name="filters-for-products"></a>
## Фильтрация продуктов

|Фильтр|Пример|Описание|
|:-|:-|:-|
|name|`filter[name]=футболка`|Фильтрация по названию
|price_from|`filter[price_from]=100`|Фильтрация по цене
|price_to|`filter[price_to]=500`|Фильтрация по цене
|size|`filter[size]=L|XL`|Фильтрация по размерам
|brand|`filter[brand]={brand_id}}`|Фильтрация по бренду
|color|`filter[color]=white|black`|Фильтрация по цвету
|categories|`filter[categories]={category_id}`|Фильтрация по категориям

<a name="get-product-by-id"></a>
## Получения продукта по ID

### `GET` **Конечная точка**


```text
/products/{id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Ceasar Wisozk Jr.",
    "description": "Quod ut quae illum eum nostrum soluta. Et eaque nesciunt aut culpa labore minima quasi enim. Nihil et et molestias sequi est aliquam ut.",
    "old_price": null,
    "price": "746.00",
    "quantity": 86,
    "features": null,
    "region": null,
    "removal_time": null,
    "seasons": [],
    "promotions": [],
    "brand": {
        "id": 3,
        "name": "Mrs. Maybelle Corwin IV",
        "logo": "https://via.placeholder.com/120x120.png/00ddcc?text=dignissimos",
        "is_main": 1,
        "products_count": null
    },
    "tags": [],
    "categories": [
        {
            "id": 1,
            "name": null,
            "icon": null,
            "cover": null,
            "order": null,
            "parent_id": null
        }
    ],
    "images": {
        "fd261ff0-570c-4cb2-8f13-d8d2c49e3c57": {
            "name": "search",
            "file_name": "search.html",
            "uuid": "fd261ff0-570c-4cb2-8f13-d8d2c49e3c57",
            "preview_url": "",
            "original_url": "http://localhost/storage/products/1/search.html",
            "order": 1,
            "custom_properties": [],
            "extension": "html",
            "size": 29630
        }
    },
    "options": [
        {
            "size": "EU 43",
            "colors": [
                {
                    "option_id": 1,
                    "quantity": 7,
                    "id": 1,
                    "name": "FireBrick",
                    "key": "Chocolate",
                    "hex": "#992ecb",
                    "created_at": "2022-02-08 16:30:52",
                    "updated_at": "2022-02-08 16:30:52"
                }
            ]
        },
        {
            "size": "EU 38",
            "colors": [
                {
                    "option_id": 2,
                    "quantity": 6,
                    "id": 2,
                    "name": "Gray",
                    "key": "LightCoral",
                    "hex": "#5d89ab",
                    "created_at": "2022-02-08 16:30:52",
                    "updated_at": "2022-02-08 16:30:52"
                }
            ]
        }
    ]
}
```

<a name="get-aviable-filters"></a>
## Получение доступных фильтров

```text
/products/filter-data
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|category_id|`nullable|int|exists:categories,id`| Номер категории
|brand_id|`nullable|int|exists:brands,id`| Идентификатор существующего бренда
|name|`nullable|string`| Имя продукта

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "brands": [
        {
            "id": 1,
            "name": "Mr. Olen Rutherford",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 2,
            "name": "Darwin Boehm",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 3,
            "name": "Daisy Kovacek",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 4,
            "name": "Miss Serena Hessel",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 5,
            "name": "Dr. Rylan Schultz",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 6,
            "name": "Leonor Schaden",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 7,
            "name": "Annamae Runolfsson",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 8,
            "name": "Floy Gislason",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 9,
            "name": "Larry Senger",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 10,
            "name": "Selina Tillman",
            "logo": null,
            "is_main": null,
            "products_count": null
        },
        {
            "id": 13,
            "name": "Dr. Laverne Prosacco DVM",
            "logo": null,
            "is_main": null,
            "products_count": null
        }
    ],
    "lowest_price": "15.00",
    "options": [
        {
            "size": "EU 44",
            "colors": [
                {
                    "id": 3,
                    "name": "BlanchedAlmond",
                    "key": "Green",
                    "hex": "#cb0063",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 1,
                    "name": "DarkRed",
                    "key": "MintCream",
                    "hex": "#9be811",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 4,
                    "name": "Aqua",
                    "key": "Coral",
                    "hex": "#fa0f1e",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 2,
                    "name": "MediumPurple",
                    "key": "ForestGreen",
                    "hex": "#e4b052",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 5,
                    "name": "Purple",
                    "key": "PaleVioletRed",
                    "hex": "#3a8baf",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                }
            ]
        },
        {
            "size": "EU 40",
            "colors": [
                {
                    "id": 5,
                    "name": "Purple",
                    "key": "PaleVioletRed",
                    "hex": "#3a8baf",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 4,
                    "name": "Aqua",
                    "key": "Coral",
                    "hex": "#fa0f1e",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 3,
                    "name": "BlanchedAlmond",
                    "key": "Green",
                    "hex": "#cb0063",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 1,
                    "name": "DarkRed",
                    "key": "MintCream",
                    "hex": "#9be811",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                },
                {
                    "id": 2,
                    "name": "MediumPurple",
                    "key": "ForestGreen",
                    "hex": "#e4b052",
                    "created_at": "2022-01-27 11:01:49",
                    "updated_at": "2022-01-27 11:01:49"
                }
            ]
        }
    ],
    "highest_price": "999.00"
}
```
