- [Вывод всех заказов](#index)
- [Создание заказа](#create)
- [Показать заказ](#show)
- [Обновление заказа](#update)
- [Удаление заказа](#delete)
- [Отправить жалобу на заказ](#report)
- [Получить данные для жалобы](#get-text-for-report)

<a name="index"></a>
## Получение всех заказов <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `GET` **Конечная точка**


```text
/user/orders
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "created_at": "2022-02-07T12:50:50.000000Z",
        "updated_at": "2022-02-07T12:50:51.000000Z",
        "status": "Ожидается оплата",
        "products": [
            {
                "id": 1,
                "quantity": 1,
                "price": "382.00",
                "option": {
                    "id": 1,
                    "color_id": 1,
                    "product_id": 1,
                    "size": "EU 38",
                    "quantity": 7,
                    "color": {
                        "id": 1,
                        "name": "Azure",
                        "key": "PapayaWhip",
                        "hex": "#6e9771",
                        "created_at": "2022-02-07 12:49:32",
                        "updated_at": "2022-02-07 12:49:32"
                    }
                },
                "product": {
                    "id": 1,
                    "name": "Mr. Christian Runolfsdottir",
                    "description": "Veniam ut eum perferendis mollitia unde. Expedita aperiam est incidunt placeat corporis. Quae placeat amet et quidem molestias numquam delectus.",
                    "old_price": null,
                    "price": "382.00",
                    "image": "http://localhost/storage/products/1/search.html",
                    "quantity": 35,
                    "tags": [],
                    "brand": {
                        "id": 4,
                        "name": "Dayne Ortiz",
                        "logo": "https://via.placeholder.com/120x120.png/00bbcc?text=pariatur",
                        "is_main": 1,
                        "products_count": null
                    }
                }
            }
        ],
        "summary_price": 382
    }
]
```

<a name="create"></a>
## Создание заказа  <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/orders
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|payment_type|`required|int`|Метод оплаты (0 - наличка, 1 - картой)
|delivery_type|`required|int`|Метод доставки (0 - в отделение, 1 - на дом)
|delivery_address|`required|string`|Адресс доствки в случае delivery_type == 1
|delivery_point_id|`required|string`|Код отделения в случае delivery_type == 0

#### Пример запроса
```json
{
	"payment_type":0,
    "delivery_type":0,
    "delivery_service":0,
    "delivery_point_id":"MSL456"
}
```


### Ответ

> {success} Успешный ответ. Код `200`


<a name="show"></a>
## Показать заказ

### `GET` **Конечная точка**
```text
/user/orders/{order}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "total": 527,
    "payment_type": "Онлайн оплата",
    "delivery_type": "Самовывоз",
    "delivery_address": null,
    "delivery_status": "Ожидается оплата",
    "products": [
        {
            "id": 1,
            "quantity": 1,
            "price": "527.00",
            "product_id": 1,
            "order_id": 1,
            "created_at": "2022-02-04T12:38:16.000000Z",
            "updated_at": "2022-02-04T12:38:16.000000Z",
            "product_option_id": 1,
            "product": {
                "id": 1,
                "name": "Godfrey Dicki",
                "description": "Eos voluptatem iure animi. Quia illum iste eius similique qui. Nulla inventore illo error incidunt consectetur commodi repellendus.",
                "old_price": null,
                "price": "527.00",
                "quantity": 36,
                "brand_id": 5,
                "status": 1,
                "created_at": "2022-02-04T12:35:33.000000Z",
                "updated_at": "2022-02-04T12:38:16.000000Z",
                "vendor_id": null,
                "weight": 70,
                "purchase_price": null,
                "region": null,
                "features": null,
                "removal_time": null,
                "purchase_price_currency": null,
                "tags": [],
                "brand": {
                    "id": 5,
                    "name": "Taurean Hodkiewicz",
                    "logo": "https://via.placeholder.com/120x120.png/003388?text=delectus",
                    "is_active": 1,
                    "is_main": 1
                }
            },
            "product_option": {
                "id": 1,
                "color_id": 5,
                "product_id": 1,
                "size": "EU 42",
                "quantity": 1,
                "color": {
                    "id": 5,
                    "name": "DarkGoldenRod",
                    "key": "Chocolate",
                    "hex": "#32c492",
                    "created_at": "2022-02-04 12:37:06",
                    "updated_at": "2022-02-04 12:37:06"
                }
            }
        }
    ]
}
```

<a name="update"></a>
## Обновление заказа <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `PUT` **Конечная точка**
```text
/user/orders/{order}
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|status|`sometimes|integer`|Статус

### Ответ

> {success} Успешный ответ. Код `200`

```json
 {
       "id": "integer",
       "total": "integer",
       "payment_type": "integer",
       "delivery_type": "integer",
       "delivery_address": "string",
        "products": [
            {
                "id": "integer",
                "quantity": "integer",
                "price": "string"
            }
        ]
    }
```

<a name="delete"></a>
## Удаление заказа <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `DELETE` **Конечная точка**
```text
/user/orders/{order}
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|status|`sometimes|integer`|Статус

### Ответ

> {success} Успешный ответ. Код `200`

```json
 {
       "id": "integer",
       "total": "integer",
       "payment_type": "integer",
       "delivery_type": "integer",
       "delivery_address": "string",
        "products": [
            {
                "id": "integer",
                "quantity": "integer",
                "price": "string"
            }
        ]
    }
```

<a name="report"></a>
## Жалоба на заказ <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/orders/report
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|trouble_text|`required|string`|Текст проблемы
|action_text|`required|string`|Текст действия с заказом
|text|`required|string`|Описание проблемы
|images|`nullable|array`|Массив изображений
|images.*|`nullable|mimes:jpg,bmp,png`|Изображение репорта
|email|`required|email|string`|Почта для взаимодействия с поддержкой
|order_id|`required|integer|exists:orders,id`|Идентификатор заказа

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 4,
    "trouble_text": "12312",
    "action_text": "123",
    "text": "1123",
    "email": "1231@asda.reo",
    "order_id": "1",
    "author_id": 1,
    "updated_at": "2022-02-04T14:04:13.000000Z",
    "created_at": "2022-02-04T14:04:13.000000Z",
    "images": [
        {
            "id": 4,
            "order_report_id": 4,
            "image": "D:\\openserver\\OpenServer\\domains\\italia\\storage\\order_report_images/75579a7ac276819d6af011db526a9240.jpg"
        }
    ]
}
```

<a name="get-text-for-report"></a>
## Получение текста для отправки жалобы <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `GET` **Конечная точка**
```text
/user/orders/report/get-properties
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "troubles": [
        "Подделка",
        "Продукт поврежден",
        "Продукт не был доставлен",
        "Продукт не соответствует описанию",
        "Несоответствие количества"
    ],
    "actions": [
        "Возврат товара и средств",
        "Частичный возврат средств",
        "Замена товара"
    ]
}
```
