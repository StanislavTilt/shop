- [Получение всех репортов](#get-all)
- [Получение конкретного репорта](#show)
- [Изменение статуса](#change-status)
- [Поиск жалоб на заказы](#search-order-reports)
- [Получение статусов](#get-statuses)

<a name="get-all"></a>
## Получение всех репортов

### `GET` **Конечная точка**
```text
/admin/order-reports/get-all
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "order_id": 1,
        "user_name": "John Doe",
        "trouble_text": "1231231",
        "action_text": "123123",
        "created_at": "2021-12-13T12:14:07.000000Z",
        "updated_at": "2021-12-13T12:14:07.000000Z"
    }
]
```


<a name="show"></a>
## Получение конкретного репорта

### `GET` **Конечная точка**
```text
/admin/order-reports/show/{report_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 2,
    "trouble_text": "12312",
    "action_text": "123",
    "text": "1123",
    "email": "1231@asda.reo",
    "order_id": 1,
    "author_id": 1,
    "updated_at": "2022-02-04T13:56:57.000000Z",
    "created_at": "2022-02-04T13:56:57.000000Z",
    "images": [
        {
            "id": 2,
            "order_report_id": 2,
            "image": "D:\\openserver\\OpenServer\\domains\\italia\\storage\\order_report_images/c41864ffce52e673a6ac350337f22d67.jpg"
        }
    ],
    "user": {
        "id": 1,
        "name": "John Doe",
        "nickname": "test123",
        "avatar": null,
        "phone": "89998887766",
        "email": "johndoe@gmail.com",
        "has_subscription": false,
        "status": "active",
        "discount": 0,
        "created_at": "2022-02-04T13:53:05.000000Z",
        "updated_at": "2022-02-04T13:53:05.000000Z"
    },
    "order": {
        "id": 1,
        "user_id": 1,
        "payment_type": "online",
        "delivery_type": "pickup",
        "delivery_address": null,
        "delivery_status": "waiting_for_payment",
        "status": "waiting_for_payment",
        "payment_time": null,
        "delivery_date": null,
        "created_at": "2022-02-04T13:56:10.000000Z",
        "updated_at": "2022-02-04T13:56:11.000000Z",
        "delivery_point_id": "MSL456",
        "order_product": [
            {
                "id": 1,
                "quantity": 1,
                "price": "759.00",
                "product_id": 1,
                "order_id": 1,
                "created_at": "2022-02-04T13:56:10.000000Z",
                "updated_at": "2022-02-04T13:56:10.000000Z",
                "product_option_id": 1,
                "product_option": {
                    "id": 1,
                    "color_id": 5,
                    "product_id": 1,
                    "size": "EU 36",
                    "quantity": 10
                },
                "product": {
                    "id": 1,
                    "name": "Desiree Reichel",
                    "description": "Sunt quos nihil rem nemo quae omnis dolorem. Modi autem id atque natus ratione expedita porro. Vero aut labore nobis id temporibus.",
                    "old_price": "8177.00",
                    "price": "759.00",
                    "quantity": 93,
                    "brand_id": 6,
                    "status": 1,
                    "created_at": "2022-02-04T13:52:11.000000Z",
                    "updated_at": "2022-02-04T13:56:10.000000Z",
                    "vendor_id": null,
                    "weight": 59,
                    "purchase_price": null,
                    "region": null,
                    "features": null,
                    "removal_time": null,
                    "purchase_price_currency": null
                }
            }
        ]
    }
}
```

<a name="change-status"></a>
## Изменение статуса

### `PUT` **Конечная точка**
```text
/admin/order-reports/change-status/{report_id}
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|status|`nullable|string`|Новый статус жалобы|
|comment|`nullable|string`|Комент к репорту

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "order_id": 1,
    "author_id": 1,
    "trouble_text": "1231231",
    "action_text": "123123",
    "text": "2123121",
    "created_at": "2021-12-13T14:48:11.000000Z",
    "updated_at": "2021-12-13T14:50:08.000000Z",
    "status": "finished",
    "admin_comment": "finished",
    "order": {
        "id": 1,
        "payment_type": 0,
        "delivery_type": 0,
        "delivery_address": null,
        "status": 0,
        "user_id": 1,
        "created_at": "2021-12-13T14:47:58.000000Z",
        "updated_at": "2021-12-13T14:47:58.000000Z",
        "delivery_point_id": "MSL456",
        "products": [
            {
                "id": 1,
                "quantity": 1,
                "price": "4.00",
                "product_id": 36,
                "order_id": 1,
                "created_at": "2021-12-13T14:47:58.000000Z",
                "updated_at": "2021-12-13T14:47:58.000000Z",
                "product": {
                    "id": 36,
                    "name": "Adeline Kutch",
                    "description": "Blanditiis voluptatem autem molestiae deleniti provident aut. Necessitatibus mollitia ullam nesciunt nihil. Optio sit porro ab laboriosam itaque voluptatem nobis.",
                    "old_price": "6774.00",
                    "price": "4.00",
                    "quantity": 56,
                    "brand_id": 8,
                    "status": 1,
                    "created_at": "2021-12-13T14:31:40.000000Z",
                    "updated_at": "2021-12-13T14:47:58.000000Z",
                    "vendor_id": null,
                    "weight": 24,
                    "purchase_price": null,
                    "region": null,
                    "features": null,
                    "removal_time": null,
                    "brand": {
                        "id": 8,
                        "name": "Dorthy Kozey",
                        "logo": "https://via.placeholder.com/120x120.png/003366?text=deserunt",
                        "is_active": 1,
                        "is_main": 1
                    }
                },
                "options": []
            }
        ]
    },
    "changes": [
        {
            "id": 1,
            "order_report_id": 1,
            "admin_id": 2,
            "new_status": "finished",
            "new_comment": "finished",
            "created_at": "2021-12-13T14:51:37.000000Z",
            "updated_at": "2021-12-13T14:51:37.000000Z"
        }
    ]
}
```

<a name="search-order-reports"></a>
## Поиск жалоб на заказы

### `POST` **Конечная точка**
```text
/admin/order-reports/search
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор жалобы
|order_id|`nullable|integer`|Идентификатор заказа
|sort_key|`nullable|string`|Столбец для сортировки
|sort_method|`nullable|string`|Метод сортировки

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "payment_type": "online",
            "delivery_type": "pickup",
            "delivery_address": null,
            "delivery_status": "waiting_for_payment",
            "status": "waiting_for_payment",
            "payment_time": null,
            "delivery_date": null,
            "created_at": "2022-02-03T19:06:17.000000Z",
            "updated_at": "2022-02-03T19:06:17.000000Z",
            "delivery_point_id": "MSL456",
            "order_product": [
                {
                    "id": 1,
                    "quantity": 1,
                    "price": "950.00",
                    "product_id": 1,
                    "order_id": 1,
                    "created_at": "2022-02-03T19:06:17.000000Z",
                    "updated_at": "2022-02-03T19:06:17.000000Z",
                    "product_option_id": 1,
                    "product": {
                        "id": 1,
                        "name": "Prof. Brandi Zemlak",
                        "description": "Praesentium voluptas sunt aut sit quis sed ea occaecati. Quisquam fugit asperiores non. Voluptatibus deserunt et est eos dolor dolor.",
                        "old_price": "9977.00",
                        "price": "950.00",
                        "quantity": 20,
                        "brand_id": 1,
                        "status": 1,
                        "created_at": "2022-02-03T19:01:03.000000Z",
                        "updated_at": "2022-02-03T19:06:56.000000Z",
                        "vendor_id": null,
                        "weight": 39,
                        "purchase_price": null,
                        "region": null,
                        "features": null,
                        "removal_time": null,
                        "purchase_price_currency": null
                    },
                    "product_option": {
                        "id": 1,
                        "color_id": 1,
                        "product_id": 1,
                        "size": "EU 35",
                        "quantity": 20,
                        "color": {
                            "id": 1,
                            "name": "DarkGreen",
                            "key": "BurlyWood",
                            "hex": "#1591be",
                            "created_at": "2022-02-03 19:02:04",
                            "updated_at": "2022-02-03 19:02:04"
                        }
                    }
                }
            ]
        }
    ],
    "links": {
        "first": "https://italia/api/admin/orders/search-orders?page=1",
        "last": "https://italia/api/admin/orders/search-orders?page=1",
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
                "url": "https://italia/api/admin/orders/search-orders?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Вперёд &raquo;",
                "active": false
            }
        ],
        "path": "https://italia/api/admin/orders/search-orders",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

<a name="get-statuses"></a>
## Получение статусов

### `GET` **Конечная точка**
```text
/admin/order-reports/get-statuses
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    "new",
    "in_process",
    "finished"
]
```
