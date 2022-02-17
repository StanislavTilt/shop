- [Получение всех заархивированных продуктов](#get-all)
- [Возврат продукта в оборот](#return)
- [Удаление](#delete)

<a name="get-all"></a>
## Получение всех заархивированных продуктов

### `POST` **Конечная точка**
```text
/admin/archive/get-all
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "Althea Feeney Jr.",
        "description": "Odit ea deserunt rerum veritatis consequatur animi. Est dolores alias dolorem aliquam sunt quae. Blanditiis cupiditate et ab distinctio facere temporibus.",
        "old_price": "4835.00",
        "price": "662.00",
        "quantity": 64,
        "features": null,
        "removal_time": null,
        "promotions": [],
        "brand": {
            "id": 3,
            "name": "Dr. Judge Beier",
            "logo": "https://via.placeholder.com/120x120.png/00eebb?text=quia",
            "is_main": 1,
            "products_count": null
        },
        "tags": [],
        "categories": [
            {
                "id": 1,
                "name": "ducimus",
                "icon": "https://via.placeholder.com/120x120.png/00ee88?text=clothes+vector+ex",
                "cover": null,
                "order": 1,
                "parent_id": null
            }
        ],
        "options": [
            {
                "id": 1,
                "name": "XS",
                "value": null
            },
            {
                "id": 2,
                "name": "S",
                "value": null
            },
            {
                "id": 3,
                "name": "M",
                "value": null
            },
            {
                "id": 4,
                "name": "L",
                "value": null
            },
            {
                "id": 5,
                "name": "XL",
                "value": null
            },
            {
                "id": 6,
                "name": "Белый",
                "value": "#ffffff"
            },
            {
                "id": 7,
                "name": "Морской",
                "value": "#43F2E8"
            },
            {
                "id": 8,
                "name": "Бежевый",
                "value": "#FFF4F2"
            }
        ],
        "images": {
            "c51007c4-c429-4d52-917d-b0b39779a9cf": {
                "name": "search",
                "file_name": "search.html",
                "uuid": "c51007c4-c429-4d52-917d-b0b39779a9cf",
                "preview_url": "",
                "original_url": "http://localhost/storage/products/1/search.html",
                "order": 1,
                "custom_properties": [],
                "extension": "html",
                "size": 29731
            }
        }
    }
]
```


<a name="return"></a>
## Возврат товара в продажу

### `GET` **Конечная точка**
```text
/admin/archive/return-to-store
```
### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|product_id|`required|integer|exists:products,id`|Идентификатор продукта|
|storefront_ids|`required|array`|Идентификаторы витрин
|storefront_ids.0|`required|integer|exists:storefronts,id`|Идентификаторы витрин
|expired_at|`required|timestamp`|Время переноса в архив


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Althea Feeney Jr.",
    "description": "Odit ea deserunt rerum veritatis consequatur animi. Est dolores alias dolorem aliquam sunt quae. Blanditiis cupiditate et ab distinctio facere temporibus.",
    "old_price": "4835.00",
    "price": "662.00",
    "quantity": 64,
    "features": null,
    "removal_time": null,
    "promotions": [],
    "brand": {
        "id": 3,
        "name": "Dr. Judge Beier",
        "logo": "https://via.placeholder.com/120x120.png/00eebb?text=quia",
        "is_main": 1,
        "products_count": null
    },
    "tags": [],
    "categories": [
        {
            "id": 1,
            "name": "ducimus",
            "icon": "https://via.placeholder.com/120x120.png/00ee88?text=clothes+vector+ex",
            "cover": null,
            "order": 1,
            "parent_id": null
        }
    ],
    "options": [
        {
            "id": 1,
            "name": "XS",
            "value": null
        },
        {
            "id": 2,
            "name": "S",
            "value": null
        },
        {
            "id": 3,
            "name": "M",
            "value": null
        },
        {
            "id": 4,
            "name": "L",
            "value": null
        },
        {
            "id": 5,
            "name": "XL",
            "value": null
        },
        {
            "id": 6,
            "name": "Белый",
            "value": "#ffffff"
        },
        {
            "id": 7,
            "name": "Морской",
            "value": "#43F2E8"
        },
        {
            "id": 8,
            "name": "Бежевый",
            "value": "#FFF4F2"
        }
    ],
    "images": {
        "c51007c4-c429-4d52-917d-b0b39779a9cf": {
            "name": "search",
            "file_name": "search.html",
            "uuid": "c51007c4-c429-4d52-917d-b0b39779a9cf",
            "preview_url": "",
            "original_url": "http://localhost/storage/products/1/search.html",
            "order": 1,
            "custom_properties": [],
            "extension": "html",
            "size": 29731
        }
    }
}
```

<a name="delete"></a>
## Удаление архивированого продукта

### `GET` **Конечная точка**
```text
/admin/archive/destroy/{id}
```


### Ответ

> {success} Успешный ответ. Код `200`
