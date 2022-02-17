- [Создание](#create)
- [Получение](#index)
- [Поиск](#search)
- [Получение конкретной](#show)
- [Обновление](#update)
- [Удаление](#destroy)

<a name="create"></a>
## Создание 

### `POST` **Конечная точка**
```text
/admin/promotions
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|title|`required|string`|Название акции|
|description|`required|string`|Описание акции|
|image|`nullable|mimes:jpeg,png,jpg,gif,svg`|Картинка акции|
|percent|`required|integer`|Процент акции|
|from_date|`required|string`|С даты акции|
|to_date|`required|string`|До даты акции|
|products_ids|`required|array`|Идентификаторы продуктов|
|products_ids.*|`required|integer|exists:products,id|unique:promotion_products,id`|Идентификатор конкретного продукта|

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 7,
    "title": "title",
    "description": "description",
    "image": "https://italia/storage/promotion_icons/2fa8ffd507707bbd9e43e48b936d55ac.png",
    "percent": "10",
    "from_date": "2012-02-16T07:00:00.000000Z",
    "to_date": "2022-02-10T07:00:00.000000Z",
    "is_active": true,
    "promotion_product": [
        {
            "id": 1,
            "promotion_id": 7,
            "product_id": 1,
            "product": {
                "id": 1,
                "name": "Ethel Lesch",
                "description": "Velit in unde totam itaque voluptas sint. Dolor tempore iste magnam harum sed vitae minima. Deserunt voluptatem vitae eius et est in quos blanditiis. Laboriosam et sunt aut excepturi.",
                "old_price": "98.00",
                "price": "88.20",
                "quantity": 87,
                "brand_id": 10,
                "status": 1,
                "created_at": "2022-02-17T11:36:02.000000Z",
                "updated_at": "2022-02-17T12:42:40.000000Z",
                "vendor_id": null,
                "weight": 90,
                "purchase_price": null,
                "region": null,
                "features": null,
                "removal_time": null,
                "purchase_price_currency": null,
                "brand": {
                    "id": 10,
                    "name": "Roxanne Collins",
                    "logo": "https://via.placeholder.com/120x120.png/00ff33?text=exercitationem",
                    "is_active": 1,
                    "is_main": 1
                },
                "tags": [],
                "categories": [
                    {
                        "id": 1,
                        "category_id": 1,
                        "product_id": 1,
                        "category": {
                            "id": 1,
                            "name": "tempore",
                            "icon": "https://via.placeholder.com/120x120.png/00cc66?text=clothes+vector+dolore",
                            "cover": null,
                            "order": 1,
                            "is_active": 1,
                            "parent_id": null
                        }
                    }
                ]
            }
        },
        {
            "id": 2,
            "promotion_id": 7,
            "product_id": 2,
            "product": {
                "id": 2,
                "name": "Tate Pouros III",
                "description": "Voluptas qui omnis dolorem rerum ullam. Officia cupiditate iste iure quaerat. Veritatis porro et molestiae sunt. Quae nobis esse rerum.",
                "old_price": "489.00",
                "price": "440.10",
                "quantity": 16,
                "brand_id": 1,
                "status": 1,
                "created_at": "2022-02-17T11:36:02.000000Z",
                "updated_at": "2022-02-17T12:42:40.000000Z",
                "vendor_id": null,
                "weight": 84,
                "purchase_price": null,
                "region": null,
                "features": null,
                "removal_time": null,
                "purchase_price_currency": null,
                "brand": {
                    "id": 1,
                    "name": "Jadyn Von",
                    "logo": "https://via.placeholder.com/120x120.png/00bbee?text=omnis",
                    "is_active": 1,
                    "is_main": 1
                },
                "tags": [],
                "categories": [
                    {
                        "id": 2,
                        "category_id": 1,
                        "product_id": 2,
                        "category": {
                            "id": 1,
                            "name": "tempore",
                            "icon": "https://via.placeholder.com/120x120.png/00cc66?text=clothes+vector+dolore",
                            "cover": null,
                            "order": 1,
                            "is_active": 1,
                            "parent_id": null
                        }
                    }
                ]
            }
        }
    ]
}
```

<a name="index"></a>
## Получение 

### `GET` **Конечная точка**
```text
/admin/promotions
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "title": "illum",
        "description": "Dolorem est magni tempore. Odit molestias velit nisi laborum eum et sint. Repellendus dolores assumenda vero rerum vel.",
        "image": "https://via.placeholder.com/640x480.png/008855?text=deserunt",
        "percent": 95,
        "from_date": "2022-02-10T08:49:11.000000Z",
        "to_date": "2022-02-17T08:49:11.000000Z",
        "is_active": 1,
        "created_at": "2022-02-10T08:49:11.000000Z",
        "updated_at": "2022-02-10T08:49:11.000000Z",
        "promotion_product": [
            {
                "id": 1,
                "promotion_id": 1,
                "product_id": 1,
                "product": {
                    "id": 1,
                    "name": "Ena Murphy V",
                    "description": "Est et ullam veritatis quod id qui aut. Qui fugiat itaque aut iusto et optio. Soluta dolore dolorem aut nulla.",
                    "old_price": "7051.00",
                    "price": "753.00",
                    "quantity": 89,
                    "brand_id": 7,
                    "status": 1,
                    "created_at": "2022-02-10T08:46:54.000000Z",
                    "updated_at": "2022-02-10T08:46:54.000000Z",
                    "vendor_id": null,
                    "weight": 85,
                    "purchase_price": null,
                    "region": null,
                    "features": null,
                    "removal_time": null,
                    "purchase_price_currency": null,
                    "brand": {
                        "id": 7,
                        "name": "Aurelio Carroll",
                        "logo": "https://via.placeholder.com/120x120.png/006699?text=doloremque",
                        "is_active": 1,
                        "is_main": 1
                    },
                    "tags": [],
                    "categories": [
                        {
                            "id": 1,
                            "category_id": 1,
                            "product_id": 1
                        }
                    ]
                }
            },
            {
                "id": 2,
                "promotion_id": 1,
                "product_id": 2,
                "product": {
                    "id": 2,
                    "name": "Edward Wisoky",
                    "description": "Dolorem explicabo ad recusandae odit ut ut porro ut. Corrupti aut sit sequi atque vel repellendus aut rerum. Placeat velit at omnis architecto iste dolorem quo.",
                    "old_price": "1785.00",
                    "price": "183.00",
                    "quantity": 69,
                    "brand_id": 5,
                    "status": 1,
                    "created_at": "2022-02-10T08:46:54.000000Z",
                    "updated_at": "2022-02-10T08:46:54.000000Z",
                    "vendor_id": null,
                    "weight": 59,
                    "purchase_price": null,
                    "region": null,
                    "features": null,
                    "removal_time": null,
                    "purchase_price_currency": null,
                    "brand": {
                        "id": 5,
                        "name": "Cristal Torp",
                        "logo": "https://via.placeholder.com/120x120.png/003311?text=hic",
                        "is_active": 1,
                        "is_main": 1
                    },
                    "tags": [],
                    "categories": [
                        {
                            "id": 2,
                            "category_id": 1,
                            "product_id": 2
                        }
                    ]
                }
            },
            {
                "id": 3,
                "promotion_id": 1,
                "product_id": 3,
                "product": {
                    "id": 3,
                    "name": "Macy Hammes",
                    "description": "Aut autem praesentium iure soluta fuga. Magnam et nemo minima et. Incidunt et aut aut. Ipsum nihil placeat unde. Aut autem magni iste inventore pariatur ut dicta.",
                    "old_price": "1717.00",
                    "price": "559.00",
                    "quantity": 44,
                    "brand_id": 10,
                    "status": 1,
                    "created_at": "2022-02-10T08:46:54.000000Z",
                    "updated_at": "2022-02-10T08:46:54.000000Z",
                    "vendor_id": null,
                    "weight": 41,
                    "purchase_price": null,
                    "region": null,
                    "features": null,
                    "removal_time": null,
                    "purchase_price_currency": null,
                    "brand": {
                        "id": 10,
                        "name": "Prof. Hertha Von IV",
                        "logo": "https://via.placeholder.com/120x120.png/008844?text=qui",
                        "is_active": 1,
                        "is_main": 1
                    },
                    "tags": [],
                    "categories": [
                        {
                            "id": 3,
                            "category_id": 1,
                            "product_id": 3
                        }
                    ]
                }
            }
        ]
    }
]
```

<a name="search"></a>
## Поиск 

### `POST` **Конечная точка**
```text
/admin/promotions/search
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор акции
|title|`nullable|string`|Название акции
|from_date|`nullable|string`|С даты акции
|to_date|`nullable|string`|До даты акции
|sort_key|`nullable|string`|Столбец для сортировки
|sort_method|`nullable|string`|Метод сортировки

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "data": [
        {
            "title": "velit",
            "description": "Quisquam aliquam ut maxime debitis voluptatem occaecati. Et fuga et id dolor aliquam sunt. Molestias optio modi rem debitis. Est reprehenderit illum voluptate alias debitis ut aliquam.",
            "image": "https://italia/storage/https://via.placeholder.com/640x480.png/00ccaa?text=qui",
            "percent": 86,
            "from_date": "2022-02-10T12:08:47.000000Z",
            "to_date": "2022-02-17T12:08:47.000000Z",
            "is_active": 1,
            "promotion_product": []
        },
        {
            "title": "title",
            "description": "description",
            "image": "https://italia/storage/promotion_icons/25143136860799acb58c27f46d5b499e.png",
            "percent": 10,
            "from_date": "2012-08-10T07:00:00.000000Z",
            "to_date": "2022-08-10T07:00:00.000000Z",
            "is_active": 1,
            "promotion_product": [
                {
                    "id": 1,
                    "promotion_id": 7,
                    "product_id": 1,
                    "product": {
                        "id": 1,
                        "name": "Prof. Brayan Berge MD",
                        "description": "Error a eaque aliquam. Eaque porro enim qui nesciunt distinctio saepe. Provident in dicta ut in. Officia aliquid est velit quas deserunt rem. Est eius recusandae cumque dolorem rerum a.",
                        "old_price": "892.00",
                        "price": "802.80",
                        "quantity": 28,
                        "brand_id": 9,
                        "status": 1,
                        "created_at": "2022-02-10T12:07:59.000000Z",
                        "updated_at": "2022-02-10T12:10:56.000000Z",
                        "vendor_id": null,
                        "weight": 77,
                        "purchase_price": null,
                        "region": null,
                        "features": null,
                        "removal_time": null,
                        "purchase_price_currency": null,
                        "brand": {
                            "id": 9,
                            "name": "Molly Gorczany DVM",
                            "logo": "https://via.placeholder.com/120x120.png/000066?text=et",
                            "is_active": 1,
                            "is_main": 1
                        },
                        "tags": [],
                        "categories": [
                            {
                                "id": 1,
                                "category_id": 1,
                                "product_id": 1
                            }
                        ]
                    }
                }
            ]
        }
    ],
    "links": {
        "first": "https://italia/api/admin/promotions/search?page=1",
        "last": "https://italia/api/admin/promotions/search?page=1",
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
                "url": "https://italia/api/admin/promotions/search?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Вперёд &raquo;",
                "active": false
            }
        ],
        "path": "https://italia/api/admin/promotions/search",
        "per_page": 10,
        "to": 7,
        "total": 7
    }
}
```

<a name="show"></a>
## Получение конкретного 

### `GET` **Конечная точка**
```text
/admin/promotions/{promotion_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "title": "1231231",
    "description": "Ipsa ex ex neque dicta est sit cumque rerum. Molestiae repellat ipsum quos beatae rerum. Quia pariatur est incidunt harum. Est explicabo nesciunt cum ut ut nobis nihil inventore.",
    "image": "https://italia/storage/https://via.placeholder.com/640x480.png/00bb11?text=eius",
    "percent": 72,
    "from_date": "2022-02-10T12:08:47.000000Z",
    "to_date": "2022-02-17T12:08:47.000000Z",
    "is_active": 1,
    "promotion_product": [
        {
            "id": 6,
            "promotion_id": 1,
            "product_id": 1,
            "product": {
                "id": 1,
                "name": "Prof. Brayan Berge MD",
                "description": "Error a eaque aliquam. Eaque porro enim qui nesciunt distinctio saepe. Provident in dicta ut in. Officia aliquid est velit quas deserunt rem. Est eius recusandae cumque dolorem rerum a.",
                "old_price": "224.78",
                "price": "62.94",
                "quantity": 28,
                "brand_id": 9,
                "status": 1,
                "created_at": "2022-02-10T12:07:59.000000Z",
                "updated_at": "2022-02-10T13:03:41.000000Z",
                "vendor_id": null,
                "weight": 77,
                "purchase_price": null,
                "region": null,
                "features": null,
                "removal_time": null,
                "purchase_price_currency": null,
                "brand": {
                    "id": 9,
                    "name": "Molly Gorczany DVM",
                    "logo": "https://via.placeholder.com/120x120.png/000066?text=et",
                    "is_active": 1,
                    "is_main": 1
                },
                "tags": [],
                "categories": [
                    {
                        "id": 1,
                        "category_id": 1,
                        "product_id": 1
                    }
                ]
            }
        },
        {
            "id": 9,
            "promotion_id": 1,
            "product_id": 4,
            "product": {
                "id": 4,
                "name": "Jameson Zemlak",
                "description": "Non explicabo consectetur soluta et qui qui molestias. Laborum quisquam aut est nulla dolor dolor nobis. Quas ipsa natus earum qui. Nemo repellat quia vel corrupti quia exercitationem corrupti non.",
                "old_price": "208.88",
                "price": "58.49",
                "quantity": 66,
                "brand_id": 2,
                "status": 1,
                "created_at": "2022-02-10T12:07:59.000000Z",
                "updated_at": "2022-02-10T13:03:41.000000Z",
                "vendor_id": null,
                "weight": 14,
                "purchase_price": null,
                "region": null,
                "features": null,
                "removal_time": null,
                "purchase_price_currency": null,
                "brand": {
                    "id": 2,
                    "name": "Abdullah Wilkinson II",
                    "logo": "https://via.placeholder.com/120x120.png/0022ee?text=optio",
                    "is_active": 1,
                    "is_main": 1
                },
                "tags": [],
                "categories": [
                    {
                        "id": 4,
                        "category_id": 1,
                        "product_id": 4
                    }
                ]
            }
        }
    ]
}
```

<a name="update"></a>
## Создание 

### `PUT` **Конечная точка**
```text
/admin/promotions/{promotion_id}
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|title|`nullable|string`|Название акции|
|description|`nullable|string`|Описание акции|
|image|`nullable|mimes:jpeg,png,jpg,gif,svg`|Картинка акции|
|percent|`nullable|integer`|Процент акции|
|from_date|`nullable|string`|С даты акции|
|to_date|`nullable|string`|До даты акции|
|is_active|`nullable|boolean`|Статус активности|
|products_ids|`nullable|array`|Идентификаторы продуктов|
|products_ids.*|`nullable|integer|exists:products,id|unique:promotion_products,id`|Идентификатор конкретного продукта|

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "title": "1231231",
    "description": "Ipsa ex ex neque dicta est sit cumque rerum. Molestiae repellat ipsum quos beatae rerum. Quia pariatur est incidunt harum. Est explicabo nesciunt cum ut ut nobis nihil inventore.",
    "image": "https://italia/storage/https://via.placeholder.com/640x480.png/00bb11?text=eius",
    "percent": 72,
    "from_date": "2022-02-10T12:08:47.000000Z",
    "to_date": "2022-02-17T12:08:47.000000Z",
    "is_active": 1,
    "promotion_product": [
        {
            "id": 6,
            "promotion_id": 1,
            "product_id": 1,
            "product": {
                "id": 1,
                "name": "Prof. Brayan Berge MD",
                "description": "Error a eaque aliquam. Eaque porro enim qui nesciunt distinctio saepe. Provident in dicta ut in. Officia aliquid est velit quas deserunt rem. Est eius recusandae cumque dolorem rerum a.",
                "old_price": "224.78",
                "price": "62.94",
                "quantity": 28,
                "brand_id": 9,
                "status": 1,
                "created_at": "2022-02-10T12:07:59.000000Z",
                "updated_at": "2022-02-10T13:03:41.000000Z",
                "vendor_id": null,
                "weight": 77,
                "purchase_price": null,
                "region": null,
                "features": null,
                "removal_time": null,
                "purchase_price_currency": null,
                "brand": {
                    "id": 9,
                    "name": "Molly Gorczany DVM",
                    "logo": "https://via.placeholder.com/120x120.png/000066?text=et",
                    "is_active": 1,
                    "is_main": 1
                },
                "tags": [],
                "categories": [
                    {
                        "id": 1,
                        "category_id": 1,
                        "product_id": 1
                    }
                ]
            }
        },
        {
            "id": 7,
            "promotion_id": 1,
            "product_id": 2,
            "product": {
                "id": 2,
                "name": "Orville Labadie",
                "description": "Adipisci quod quos sit tenetur qui cum accusantium corporis. Quasi temporibus maiores dolores cumque eos nihil. Qui id distinctio cumque corporis. Quia vel maiores illum.",
                "old_price": "172.76",
                "price": "48.37",
                "quantity": 24,
                "brand_id": 5,
                "status": 1,
                "created_at": "2022-02-10T12:07:59.000000Z",
                "updated_at": "2022-02-10T13:03:41.000000Z",
                "vendor_id": null,
                "weight": 43,
                "purchase_price": null,
                "region": null,
                "features": null,
                "removal_time": null,
                "purchase_price_currency": null,
                "brand": {
                    "id": 5,
                    "name": "Mireille Kuhlman II",
                    "logo": "https://via.placeholder.com/120x120.png/0011bb?text=eos",
                    "is_active": 1,
                    "is_main": 1
                },
                "tags": [],
                "categories": [
                    {
                        "id": 2,
                        "category_id": 1,
                        "product_id": 2
                    }
                ]
            }
        }
    ]
}
```

<a name="destroy"></a>
## Удаление 

### `DELETE` **Конечная точка**
```text
/admin/promotions/{promotion_id}
```

### Ответ

> {success} Успешный ответ. Код `200`
