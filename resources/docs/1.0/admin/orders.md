- [Получение](#show)
- [Получение всех](#get-all)
- [Обновление заказа](#update)
- [Удаление](#delete)
- [Удаление](#delete-product-from-order)
- [Экспорт заказа в xml](#export-xml)
- [Поиск заказов](#search-orders)
- [Получение статусов доставки](#get-delivery-statuses)


<a name="show"></a>
## Получение

### `GET` **Конечная точка**
```text
/admin/orders/show/{order_id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "user_id": 1,
    "payment_type": "cash",
    "delivery_type": "pickup",
    "delivery_address": null,
    "status": "waiting_for_payment",
    "payment_time": null,
    "delivery_date": null,
    "created_at": "2022-01-25T17:42:51.000000Z",
    "updated_at": "2022-01-25T17:42:51.000000Z",
    "delivery_point_id": "MSL456",
    "order_product": [
        {
            "id": 1,
            "quantity": 1,
            "price": "515.00",
            "product_id": 1,
            "order_id": 1,
            "created_at": "2022-01-25T17:42:51.000000Z",
            "updated_at": "2022-01-25T17:42:51.000000Z",
            "product_option_id": 1,
            "product": {
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
                "brand": {
                    "id": 2,
                    "name": "Miss Gertrude Bayer",
                    "logo": "https://via.placeholder.com/120x120.png/00dd22?text=consequatur",
                    "is_active": 1,
                    "is_main": 1
                },
                "attributes": [
                    {
                        "id": 1,
                        "name": "Размеры",
                        "type": "multiselect",
                        "key": "size",
                        "sort_order": 0,
                        "is_required": 0,
                        "pivot": {
                            "optionable_id": 1,
                            "attribute_id": 1
                        }
                    },
                    {
                        "id": 2,
                        "name": "Цвет",
                        "type": "multiselect",
                        "key": "color",
                        "sort_order": 1,
                        "is_required": 0,
                        "pivot": {
                            "optionable_id": 1,
                            "attribute_id": 2
                        }
                    }
                ]
            },
            "product_option": {
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
            }
        }
    ]
}
```

<a name="get-all"></a>
## Получение всех

### `GET` **Конечная точка**
```text
/admin/orders/get-all
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "client_name": "test",
        "client_phone": "",
        "created_at": "2021-11-11T18:00:27.000000Z",
        "status": 0,
        "summary_price": 995
    },
    {
        "id": 1,
        "client_name": "test",
        "client_phone": "",
        "created_at": "2021-11-11T18:00:27.000000Z",
        "status": 0,
        "summary_price": 995
    }
]
```

<a name="update"></a>
## Обновление

### `POST` **Конечная точка**
```text
/admin/orders/update-status
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|order_id|`required|integer|exists:orders,id`|Идентификатор заказа|
|status|`required|integer|rule in order statuses`|Новый статус заказа|
|delivery_date|`required|string`|Ожидаемая дата доставки|
|delivery_status|`required|string`|Статус доставки|

### Ответ

> {success} Успешный ответ. Код `200`

<a name="delete-product-from-order"></a>
## Удаление продукта из заказа

### `POST` **Конечная точка**
```text
/admin/orders/delete-product-from-order
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|order_id|`required|integer|exists:orders,id`|Идентификатор заказа|
|product_id|`required|integer|exists:products,id`|Идентификатор товара

### Ответ

> {success} Успешный ответ. Код `204`


<a name="export-xml"></a>
## Экспорт полной информации о заказе в xml

### `POST` **Конечная точка**
```text
/admin/orders/export-order-info/1
```

### Ответ

> {success} Успешный ответ. Код `204`

```xml
<?xml version="1.0"?>
<?xml version="1.0"?>
<root>
    <id>1</id>
    <payment_type>0</payment_type>
    <delivery_type>0</delivery_type>
    <delivery_address></delivery_address>
    <status>0</status>
    <user_id>1</user_id>
    <created_at>2022-01-26T08:57:12.000000Z</created_at>
    <updated_at>2022-01-26T08:57:12.000000Z</updated_at>
    <delivery_point_id>MSL456</delivery_point_id>
    <payment_time></payment_time>
    <delivery_date></delivery_date>
    <delivery_status>waiting_for_payment</delivery_status>
    <order_product>
        <id>1</id>
        <quantity>1</quantity>
        <price>633.00</price>
        <product_id>1</product_id>
        <order_id>1</order_id>
        <created_at>2022-01-26T08:57:12.000000Z</created_at>
        <updated_at>2022-01-26T08:57:12.000000Z</updated_at>
        <product_option_id>1</product_option_id>
        <product>
            <id>1</id>
            <name>Ms. Angela Goldner</name>
            <description>Animi temporibus quibusdam beatae id. Non nulla quidem tempora est. Omnis itaque autem assumenda voluptate.</description>
            <old_price></old_price>
            <price>633.00</price>
            <quantity>85</quantity>
            <brand_id>6</brand_id>
            <status>1</status>
            <created_at>2022-01-26T08:52:40.000000Z</created_at>
            <updated_at>2022-01-26T08:57:35.000000Z</updated_at>
            <vendor_id></vendor_id>
            <weight>84</weight>
            <purchase_price></purchase_price>
            <region></region>
            <features></features>
            <removal_time></removal_time>
            <purchase_price_currency></purchase_price_currency>
            <brand>
                <id>6</id>
                <name>Prof. Lavon Stamm</name>
                <logo>https://via.placeholder.com/120x120.png/0099cc?text=odit</logo>
                <is_active>1</is_active>
                <is_main>1</is_main>
            </brand>
        </product>
        <product_option>
            <id>1</id>
            <color_id>5</color_id>
            <product_id>1</product_id>
            <size>EU 35</size>
            <quantity>12</quantity>
            <color>
                <id>5</id>
                <name>RosyBrown</name>
                <key>Beige</key>
                <hex>#75d8d1</hex>
                <created_at>2022-01-26 08:53:39</created_at>
                <updated_at>2022-01-26 08:53:39</updated_at>
            </color>
        </product_option>
    </order_product>
    <user>
        <id>1</id>
        <name>John Doe</name>
        <nickname>test123</nickname>
        <avatar></avatar>
        <phone>89998887766</phone>
        <email>johndoe@gmail.com</email>
        <has_subscription></has_subscription>
        <status>1</status>
        <created_at>2022-01-26T08:53:35.000000Z</created_at>
        <updated_at>2022-01-26T08:53:35.000000Z</updated_at>
        <mute>0</mute>
        <discount>0</discount>
    </user>
    <order_changes>
        <id>1</id>
        <order_id>1</order_id>
        <new_status>0</new_status>
        <deleted_product_id></deleted_product_id>
        <system_change>1</system_change>
        <created_at>2022-01-26T08:57:13.000000Z</created_at>
        <updated_at>2022-01-26T08:57:13.000000Z</updated_at>
        <admin_changed_id></admin_changed_id>
    </order_changes>
</root>
```

<a name="search-orders"></a>
## Поиск

### `POST` **Конечная точка**
```text
/admin/orders/search-orders
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор заказа|
|user_id|`nullable|integer`|Идентификатор пользователя
|created_at|`nullable|string`|Дата оформления заказа
|status|`nullable|integer`|Идентификатор статуса
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
            "payment_type": "cash",
            "delivery_type": "pickup",
            "delivery_address": null,
            "status": "waiting_for_payment",
            "payment_time": null,
            "delivery_date": null,
            "created_at": "2022-01-25T17:42:51.000000Z",
            "updated_at": "2022-01-25T17:42:51.000000Z",
            "delivery_point_id": "MSL456",
            "order_product": [
                {
                    "id": 1,
                    "quantity": 1,
                    "price": "515.00",
                    "product_id": 1,
                    "order_id": 1,
                    "created_at": "2022-01-25T17:42:51.000000Z",
                    "updated_at": "2022-01-25T17:42:51.000000Z",
                    "product_option_id": 1,
                    "product": {
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
                        "purchase_price_currency": null
                    },
                    "product_option": {
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

<a name="get-delivery-statuses"></a>
## Получение статусов доставки

### `GET` **Конечная точка**
```text
/admin/orders/get-statuses
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "delivery_statuses": [
        "waiting_for_payment",
        "paid",
        "on_the_way",
        "completed",
        "canceled"
    ],
    "order_statuses": {
        "waiting_for_payment": 0,
        "declined": 1,
        "payed": 2
    }
}
```
