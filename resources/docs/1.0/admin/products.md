- [Создание](#create)
- [Поиск](#search)
- [Удаление](#destroy)
- [Обновление](#update)
- [Получение продукта по идентификатору](#get-by-id)
- [Получение данных для создания продукта](#get-data-for-product)
- [Расчет стоимости продукта](#count-price)

<a name="create"></a>
## Создание продукта

### `POST` **Конечная точка**
```text
/admin/products/create
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя продукта|
|brand_id|`required|integer|exists:brands,id`|Ид бренда
|categories|`required|array`|Выбраные категории для продуктов
|categories.0|`required|integer|exists:categories,id`|Выбраные категории для продуктов
|purchase_price|`required|integer`|Стоимость закупки
|region|`required|string`|Регион продукта
|weight|`required|integer`|Вес товара
|price|`required|integer`|Стоимость покупки
|old_price|`required|integer`|Стоимость покупки со скидкой
|status|`required|boolean`|Статус
|description|`required|string`|Описание товара
|vendor_id|`required|integer|exists:vendors,id`|Поставщик
|storefronts|`required|array`|Витрины
|storefronts.0.id|`required|integer|exists:storefronts,id`|Идентификатор витрины
|storefronts.0.value|`required|boolean`|Значение для определенной витрины
|tags|`required|array`|Теги
|tags.0|`required|integer|exists:tags,id`|Идентификатор тега выбранного для товара
|options|`required|array`|Атрибуты товара
|options.0.size|`required|string`|Размер
|options.0.color_id|`required|integer|exists:colors,id`|Цвет
|options.0.quantity|`required|integer`|Количество выбраного товара с данными параметрами
|photos|`required|array`|Изображения товара
|photos.0|`mimes:jpeg,png,jpg,gif,svg`|Изображения товара
|expired_at|`required|string`|Время истечения срока жизни товара
|season_ids|`required|array`|Идентификаторы сезонов продукта
|season_ids.0|`required|integer|exists:seasons,id`|Существующий идентификатор сезона
|features|`required|string`|Описание товара

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "name": "name",
    "description": "description",
    "old_price": "50",
    "price": "100",
    "brand_id": "1",
    "status": "1",
    "purchase_price": "100",
    "region": "America",
    "weight": "100",
    "vendor_id": "1",
    "features": "хлопок шерсть",
    "quantity": 100,
    "updated_at": "2021-12-01T11:19:33.000000Z",
    "created_at": "2021-12-01T11:19:33.000000Z",
    "id": 67,
    "brand": {
        "id": 1,
        "name": "Verna Gorczany",
        "logo": "https://via.placeholder.com/120x120.png/007722?text=fuga",
        "is_active": 1,
        "is_main": 1
    },
    "vendor": {
        "id": 1,
        "name": "name",
        "is_active": 1
    },
    "tags": [
        {
            "id": 1,
            "title": "Акция",
            "key": "stock",
            "order": 0,
            "pivot": {
                "product_id": 67,
                "tag_id": 1
            }
        }
    ],
    "storefronts": [
        {
            "id": 1,
            "title": "Новинки",
            "cover": "https://source.unsplash.com/600x600?clothes,shoes",
            "key": "new_items",
            "parameters": [
                {
                    "key": "products_lifetime",
                    "name": "Время жизни товаров (в днях)",
                    "value": 7
                }
            ],
            "created_at": null,
            "updated_at": null,
            "pivot": {
                "product_id": 67,
                "storefront_id": 1,
                "expired_at": "2021-11-10 16:33:33"
            }
        }
    ],
    "product_seasons": [
        {
            "id": 1,
            "product_id": 67,
            "season_id": 1,
            "season": {
                "id": 1,
                "name": "Зима"
            }
        }
    ]
}
```

<a name="search"></a>
## Поиск

### `POST` **Конечная точка**
```text
/admin/products/search-products
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор продукта|
|name|`nullable|integer`|Название продукта
|category|`nullable|string`|Название категории
|brand|`nullable|integer`|Название бренда
|sort_key|`nullable|string`|Столбец для сортировки
|sort_method|`nullable|string`|Метод сортировки

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "data": [
        {
            "id": 1,
            "name": "Lenore Hand",
            "description": "Omnis qui excepturi dicta qui quasi et eos. Veritatis est qui et porro repellat. Enim excepturi incidunt ullam eos ullam. Nobis similique hic occaecati non accusantium ipsam.",
            "old_price": "3403.00",
            "price": "515.00",
            "quantity": 57,
            "features": null,
            "region": null,
            "removal_time": null,
            "created_at": "2022-02-11T18:18:25.000000Z",
            "updated_at": "2022-02-11T18:18:25.000000Z",
            "vendor_id": null,
            "weight": 34,
            "purchase_price": null,
            "purchase_price_currency": null,
            "promotionable": false,
            "promotions": [],
            "brand": {
                "id": 4,
                "name": "Jermain Glover",
                "logo": "https://via.placeholder.com/120x120.png/0099ee?text=aut",
                "is_main": 1,
                "products_count": null
            },
            "categories": [
                {
                    "id": 1,
                    "category_id": 1,
                    "product_id": 1,
                    "category": {
                        "id": 1,
                        "name": "autem",
                        "icon": "https://italia/storage/https://via.placeholder.com/120x120.png/00ee22?text=clothes+vector+at",
                        "cover": null,
                        "order": 1,
                        "parent_id": null
                    }
                }
            ],
            "images": {
                "0dbefcfb-4848-438f-8302-bc93a0477eca": {
                    "name": "search",
                    "file_name": "search.html",
                    "uuid": "0dbefcfb-4848-438f-8302-bc93a0477eca",
                    "preview_url": "",
                    "original_url": "http://localhost/storage/products/1/search.html",
                    "order": 1,
                    "custom_properties": [],
                    "extension": "html",
                    "size": 29797
                }
            },
            "options": [
                {
                    "id": 1,
                    "name": "XS",
                    "value": null,
                    "key": "XS",
                    "attribute_id": 1,
                    "pivot": {
                        "optionable_id": 1,
                        "attribute_option_id": 1,
                        "optionable_type": "products",
                        "quantity": 0
                    }
                },
                {
                    "id": 2,
                    "name": "S",
                    "value": null,
                    "key": "S",
                    "attribute_id": 1,
                    "pivot": {
                        "optionable_id": 1,
                        "attribute_option_id": 2,
                        "optionable_type": "products",
                        "quantity": 0
                    }
                }
            ]
        }
    ],
    "links": {
        "first": "https://italia/api/admin/products/search-products?page=1",
        "last": "https://italia/api/admin/products/search-products?page=7",
        "prev": null,
        "next": "https://italia/api/admin/products/search-products?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 7,
        "links": [
            {
                "url": null,
                "label": "&laquo; Назад",
                "active": false
            },
            {
                "url": "https://italia/api/admin/products/search-products?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "https://italia/api/admin/products/search-products?page=2",
                "label": "Вперёд &raquo;",
                "active": false
            }
        ],
        "path": "https://italia/api/admin/products/search-products",
        "per_page": 10,
        "to": 10,
        "total": 66
    }
}
```

<a name="get-by-id"></a>
## Получение продукта по идентификатору

### `GET` **Конечная точка**
```text
/admin/products/show/{product_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Mrs. Andreane Kuhic Jr.",
    "description": "Non corporis at qui amet at omnis. Natus sunt quaerat nihil adipisci esse excepturi aut. Incidunt veniam accusantium ab ab accusamus quo. Magnam est et totam aut.",
    "old_price": "8504.00",
    "price": "515.00",
    "quantity": 29,
    "brand_id": 2,
    "status": 1,
    "created_at": "2022-01-25T17:40:51.000000Z",
    "updated_at": "2022-01-25T17:42:51.000000Z",
    "vendor_id": null,
    "weight": 23,
    "purchase_price": null,
    "region": null,
    "features": null,
    "removal_time": null,
    "purchase_price_currency": null,
    "images": {
        "ae55d51f-82ef-4a76-9e00-8ca7a614a8dd": {
            "name": "search",
            "file_name": "search.html",
            "uuid": "ae55d51f-82ef-4a76-9e00-8ca7a614a8dd",
            "preview_url": "",
            "original_url": "http://localhost/storage/products/1/search.html",
            "order": 1,
            "custom_properties": [],
            "extension": "html",
            "size": 29726
        }
    },
    "categories": [
        {
            "id": 1,
            "category_id": 1,
            "product_id": 1,
            "category": {
                "id": 1,
                "name": "aut",
                "icon": "https://via.placeholder.com/120x120.png/00ddee?text=clothes+vector+odio",
                "cover": null,
                "order": 1,
                "is_active": 1,
                "parent_id": null
            }
        }
    ],
    "brand": {
        "id": 2,
        "name": "Miss Gertrude Bayer",
        "logo": "https://via.placeholder.com/120x120.png/00dd22?text=consequatur",
        "is_active": 1,
        "is_main": 1
    },
    "tags": [],
    "product_options": [
        {
            "id": 1,
            "color_id": 4,
            "product_id": 1,
            "size": "EU 38",
            "quantity": 2,
            "color": {
                "id": 4,
                "name": "LightYellow",
                "key": "LightSlateGray",
                "hex": "#e2ea8b",
                "created_at": "2022-01-25 17:41:52",
                "updated_at": "2022-01-25 17:41:52"
            }
        },
        {
            "id": 2,
            "color_id": 3,
            "product_id": 1,
            "size": "EU 37",
            "quantity": 10,
            "color": {
                "id": 3,
                "name": "MediumPurple",
                "key": "DarkTurquoise",
                "hex": "#342e8f",
                "created_at": "2022-01-25 17:41:52",
                "updated_at": "2022-01-25 17:41:52"
            }
        }
    ],
    "storefronts": [
        {
            "id": 1,
            "product_id": 1,
            "storefront_id": 1,
            "expired_at": "2022-02-01 17:41:49",
            "storefront": {
                "id": 1,
                "title": "Новинки",
                "cover": "https://source.unsplash.com/600x600?clothes,shoes",
                "key": "new_items",
                "parameters": [
                    {
                        "key": "products_lifetime",
                        "name": "Время жизни товаров (в днях)",
                        "value": 7
                    }
                ],
                "created_at": null,
                "updated_at": null,
                "changeable": 0
            }
        }
    ],
    "product_seasons": [],
    "admin_product": null,
    "media": [
        {
            "id": 1,
            "model_type": "products",
            "model_id": 1,
            "uuid": "ae55d51f-82ef-4a76-9e00-8ca7a614a8dd",
            "collection_name": "productImage",
            "name": "search",
            "file_name": "search.html",
            "mime_type": "text/html",
            "disk": "products",
            "conversions_disk": "products",
            "size": 29726,
            "manipulations": [],
            "custom_properties": [],
            "generated_conversions": [],
            "responsive_images": [],
            "order_column": 1,
            "created_at": "2022-01-25T17:40:54.000000Z",
            "updated_at": "2022-01-25T17:40:54.000000Z",
            "original_url": "http://localhost/storage/products/1/search.html",
            "preview_url": ""
        }
    ]
}
```

<a name="destroy"></a>
## Удаление пользователя

### `DELETE` **Конечная точка**
```text
/admin/products/{product_id}
```

### Ответ

> {success} Успешный ответ. Код `200`


<a name="update"></a>
## Создание продукта

### `PUT` **Конечная точка**
```text
/admin/products/:product_id
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя продукта|
|brand_id|`required|integer|exists:brands,id`|Ид бренда
|categories|`required|array`|Выбраные категории для продуктов
|categories.0|`required|integer|exists:categories,id`|Выбраные категории для продуктов
|purchase_price|`required|integer`|Стоимость закупки
|region|`required|string`|Регион продукта
|weight|`required|integer`|Вес товара
|price|`required|integer`|Стоимость покупки
|old_price|`required|integer`|Стоимость покупки со скидкой
|status|`required|boolean`|Статус
|description|`required|string`|Описание товара
|vendor_id|`required|integer|exists:vendors,id`|Поставщик
|storefronts|`required|array`|Витрины
|storefronts.0.id|`required|integer|exists:storefronts,id`|Идентификатор витрины
|storefronts.0.value|`required|boolean`|Значение для определенной витрины
|tags|`required|array`|Теги
|tags.0|`required|integer|exists:tags,id`|Идентификатор тега выбранного для товара
|options|`required|array`|Атрибуты товара
|options.0.size|`required|string`|Размер
|options.0.color_id|`required|integer|exists:colors,id`|Цвет
|options.0.quantity|`required|integer`|Количество выбраного товара с данными параметрами
|photos|`required|array`|Изображения товара
|photos.0|`mimes:jpeg,png,jpg,gif,svg`|Изображения товара
|expired_at|`required|string`|Время истечения срока жизни товара
|season_ids|`required|array`|Идентификаторы сезонов продукта
|season_ids.0|`required|integer|exists:seasons,id`|Существующий идентификатор сезона
|features|`required|string`|Описание товара

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "name": "name",
    "description": "description",
    "old_price": "50",
    "price": "100",
    "brand_id": "1",
    "status": "1",
    "purchase_price": "100",
    "region": "America",
    "weight": "100",
    "vendor_id": "1",
    "features": "хлопок шерсть",
    "quantity": 100,
    "updated_at": "2021-12-01T11:19:33.000000Z",
    "created_at": "2021-12-01T11:19:33.000000Z",
    "id": 67,
    "brand": {
        "id": 1,
        "name": "Verna Gorczany",
        "logo": "https://via.placeholder.com/120x120.png/007722?text=fuga",
        "is_active": 1,
        "is_main": 1
    },
    "vendor": {
        "id": 1,
        "name": "name",
        "is_active": 1
    },
    "tags": [
        {
            "id": 1,
            "title": "Акция",
            "key": "stock",
            "order": 0,
            "pivot": {
                "product_id": 67,
                "tag_id": 1
            }
        }
    ],
    "storefronts": [
        {
            "id": 1,
            "title": "Новинки",
            "cover": "https://source.unsplash.com/600x600?clothes,shoes",
            "key": "new_items",
            "parameters": [
                {
                    "key": "products_lifetime",
                    "name": "Время жизни товаров (в днях)",
                    "value": 7
                }
            ],
            "created_at": null,
            "updated_at": null,
            "pivot": {
                "product_id": 67,
                "storefront_id": 1,
                "expired_at": "2021-11-10 16:33:33"
            }
        }
    ],
    "product_seasons": [
        {
            "id": 1,
            "product_id": 67,
            "season_id": 1,
            "season": {
                "id": 1,
                "name": "Зима"
            }
        }
    ]
}
```

<a name="get-data-for-product"></a>
## Расчет стоимости

### `GET` **Конечная точка**
```text
/admin/products/data-for-product
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "brands": [
        {
            "id": 1,
            "name": "Khalil Leannon",
            "logo": "https://via.placeholder.com/120x120.png/00ccff?text=incidunt",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 2,
            "name": "Miss Jude Rogahn",
            "logo": "https://via.placeholder.com/120x120.png/00ccff?text=modi",
            "is_active": 1,
            "is_main": 1
        }
    ],
    "tags": [
        {
            "id": 1,
            "title": "Акция",
            "key": "stock",
            "order": 0,
        },
        {
            "id": 2,
            "title": "Скидка",
            "key": "discount",
            "order": 1
        },
        {
            "id": 3,
            "title": "Хит",
            "key": "hit",
            "order": 2
        }
    ],
    "colors": [
        {
            "id": 1,
            "name": "LightGray",
            "key": "Chartreuse",
            "hex": "#0410b9",
            "created_at": "2022-01-26 08:53:39",
            "updated_at": "2022-01-26 08:53:39"
        },
        {
            "id": 2,
            "name": "LightSkyBlue",
            "key": "Gold",
            "hex": "#11601c",
            "created_at": "2022-01-26 08:53:39",
            "updated_at": "2022-01-26 08:53:39"
        }
    ],
    "seasons": [
        {
            "id": 1,
            "name": "Зима"
        },
        {
            "id": 2,
            "name": "Весна"
        },
        {
            "id": 3,
            "name": "Лето"
        },
        {
            "id": 4,
            "name": "Осень"
        }
    ],
    "categories": [
        {
            "id": 1,
            "name": "minus",
            "icon": "https://via.placeholder.com/120x120.png/00ddff?text=clothes+vector+molestias",
            "cover": null,
            "order": 1,
            "is_active": 1,
            "parent_id": null,
            "children": [
                {
                    "id": 2,
                    "name": "qui",
                    "icon": "https://via.placeholder.com/120x120.png/0011ff?text=clothes+vector+velit",
                    "cover": null,
                    "order": 4,
                    "is_active": 1,
                    "parent_id": 1,
                    "children": []
                },
                {
                     "id": 3,
                     "name": "officia",
                     "icon": "https://via.placeholder.com/120x120.png/009922?text=clothes+vector+est",
                     "cover": null,
                     "order": 5,
                     "is_active": 1,
                     "parent_id": 1,
                     "children": []
                },
                {
                     "id": 4,
                     "name": "laboriosam",
                     "icon": "https://via.placeholder.com/120x120.png/001199?text=clothes+vector+praesentium",
                     "cover": null,
                     "order": 6,
                     "is_active": 1,
                     "parent_id": 1,
                     "children": []
                },
                {
                      "id": 5,
                      "name": "quis",
                      "icon": "https://via.placeholder.com/120x120.png/005599?text=clothes+vector+occaecati",
                      "cover": null,
                      "order": 7,
                      "is_active": 1,
                      "parent_id": 1,
                      "children": []
                },
                {
                       "id": 6,
                       "name": "hic",
                       "icon": "https://via.placeholder.com/120x120.png/003355?text=clothes+vector+excepturi",
                       "cover": null,
                       "order": 8,
                       "is_active": 1,
                       "parent_id": 1,
                       "children": []
                }
            ]
        },
        {
            "id": 2,
            "name": "deleniti",
            "icon": "https://via.placeholder.com/120x120.png/00ff44?text=clothes+vector+quis",
            "cover": null,
            "order": 4,
            "is_active": 1,
            "parent_id": 1,
            "children": []
        }
    ],
    "storefronts": [
        {
            "id": 1,
            "title": "Новинки",
            "cover": "https://source.unsplash.com/600x600?clothes,shoes",
            "key": "new_items",
            "parameters": [
                {
                    "key": "products_lifetime",
                    "name": "Время жизни товаров (в днях)",
                    "value": 7
                }
            ],
            "created_at": null,
            "updated_at": null,
            "changeable": 0
        }
    ],
    "countries": [
        {
            "id": 1,
            "location_id": 2,
            "name": "Ангилья",
            "code": "AI"
        },
        {
            "id": 2,
            "location_id": 2,
            "name": "Антигуа и Барбуда",
            "code": "AG"
        }
    ],
    "vendors": [
        {
            "id": 1,
            "name": "Dessie Gerlach",
            "is_active": 1
        },
        {
            "id": 2,
            "name": "Mr. Marty Kilback",
            "is_active": 1
        }
    ]
}
```

<a name="count-price"></a>
## Расчет стоимости

### `POST` **Конечная точка**
```text
/admin/products/count-price
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|price|`required|string`|Стоимость закупки|
|currency|`required|string`|Валюта закупки
|weight|`required`|Вес товара
|country|`required|string`|Страна производитель


### Ответ

> {success} Успешный ответ. Код `200`

```json
19820.34
```
