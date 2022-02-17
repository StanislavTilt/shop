- [Создание](#create)
- [Получение](#show)
- [Получение всех](#get-all)
- [Обновление](#update)
- [Удаление](#delete)
- [Регенерация пароля](#regenerate-password)
- [Поиск пользователей](#search-users)

<a name="create"></a>
## Создание пользователя

### `POST` **Конечная точка**
```text
/admin/users/create
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя
|nickname|`string|unique:users,nickname`|Ник 
|phone|`required|string|unique:users,phone`|Номер 
|email|`string|unique:users,email`|Электронная почта
|password|`required|string|min:6|max:32|confirmed`|Пароль
|password_confirmed|`required|string|min:6|max:32`|Подтверждение пароля

### Ответ

> {success} Успешный ответ. Код `200`

<a name="show"></a>
## Получение конкретного пользователя
### `GET` **Конечная точка**
```text
/admin/users/show/{user_id}
```

### Ответ

> {success} Успешный ответ. Код `200`
```json
{
    "id": 1,
    "name": "John Doe",
    "nickname": "test123",
    "phone": "89998887766",
    "email": "johndoe@gmail.com",
    "status": "active",
    "avatar": null,
    "discount": 0,
    "orders_count": 1,
    "orders_sum_price": 1,
    "has_subscription": false,
    "created_at": "2021-12-28T17:15:25.000000Z",
    "updated_at": "2021-12-28T17:15:25.000000Z",
    "orders": [
        {
            "id": 1,
            "payment_type": 1,
            "delivery_type": "cdek",
            "delivery_address": "123",
            "status": "waiting_for_payment",
            "created_at": "2021-12-28T20:04:55.000000Z",
            "updated_at": "2021-12-28T20:05:57.000000Z",
            "delivery_point_id": "2312",
            "products": [
                {
                    "id": 1,
                    "quantity": 1,
                    "price": "1.00",
                    "product_id": 46,
                    "order_id": 1,
                    "created_at": "2021-12-28T20:06:27.000000Z",
                    "updated_at": "2021-12-28T20:06:28.000000Z",
                    "product": {
                        "id": 46,
                        "name": "Angelina Batz",
                        "description": "Recusandae est quas aperiam reprehenderit. Possimus explicabo quam sequi aut voluptatibus voluptatem.",
                        "old_price": null,
                        "price": "542.00",
                        "quantity": 71,
                        "brand_id": 4,
                        "status": 1,
                        "created_at": "2021-12-28T17:14:59.000000Z",
                        "updated_at": "2021-12-28T17:14:59.000000Z",
                        "vendor_id": null,
                        "weight": 29,
                        "purchase_price": null,
                        "region": null,
                        "features": null,
                        "removal_time": null,
                        "options": [
                            {
                                "id": 1,
                                "name": "XS",
                                "value": null,
                                "key": "XS",
                                "attribute_id": 1,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 1,
                                    "optionable_type": "products",
                                    "quantity": 18
                                }
                            },
                            {
                                "id": 2,
                                "name": "S",
                                "value": null,
                                "key": "S",
                                "attribute_id": 1,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 2,
                                    "optionable_type": "products",
                                    "quantity": 18
                                }
                            },
                            {
                                "id": 3,
                                "name": "M",
                                "value": null,
                                "key": "M",
                                "attribute_id": 1,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 3,
                                    "optionable_type": "products",
                                    "quantity": 18
                                }
                            },
                            {
                                "id": 4,
                                "name": "L",
                                "value": null,
                                "key": "L",
                                "attribute_id": 1,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 4,
                                    "optionable_type": "products",
                                    "quantity": 18
                                }
                            },
                            {
                                "id": 5,
                                "name": "XL",
                                "value": null,
                                "key": "XL",
                                "attribute_id": 1,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 5,
                                    "optionable_type": "products",
                                    "quantity": 18
                                }
                            },
                            {
                                "id": 6,
                                "name": "Белый",
                                "value": "#ffffff",
                                "key": "white",
                                "attribute_id": 2,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 6,
                                    "optionable_type": "products",
                                    "quantity": 88
                                }
                            },
                            {
                                "id": 7,
                                "name": "Морской",
                                "value": "#43F2E8",
                                "key": "sea",
                                "attribute_id": 2,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 7,
                                    "optionable_type": "products",
                                    "quantity": 88
                                }
                            },
                            {
                                "id": 8,
                                "name": "Бежевый",
                                "value": "#FFF4F2",
                                "key": "beige",
                                "attribute_id": 2,
                                "pivot": {
                                    "optionable_id": 46,
                                    "attribute_option_id": 8,
                                    "optionable_type": "products",
                                    "quantity": 88
                                }
                            }
                        ]
                    }
                }
            ]
        }
    ]
}
```

<a name="get-all"></a>
## Получение всех пользователей

### `GET` **Конечная точка**
```text
/admin/users/get-all
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "John Doe",
        "nickname": "test123",
        "phone": "89998887766",
        "email": "johndoe@gmail.com",
        "orders_count": 1,
        "orders_sum_price": 1,
        "status": "active"
    }
]
```


<a name="update"></a>
## Обновление пользователя

### `POST` **Конечная точка**
```text
/admin/users/update/{user_id}
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`string`|Имя
|nickname|`string|unique:users,nickname`|Ник 
|phone|`required|string|unique:users,phone`|Номер 
|email|`string|unique:users,email`|Электронная почта
|mute|`integer`|Время мута
|ban|`boolean`|Статус бана
|discount|`integer`|Группа скидки

### Ответ

> {success} Успешный ответ. Код `200`

<a name="destroy"></a>
## Удаление пользователя

### `POST` **Конечная точка**
```text
/admin/users/destroy/1
```

### Ответ

> {success} Успешный ответ. Код `200`

<a name="regenerate-password"></a>
## Регенерация пароля пользователя
### `GET` **Конечная точка**
```text
/admin/users/regenerate-password/{user_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

<a name="search-users"></a>
## Поиск

### `POST` **Конечная точка**
```text
/admin/users/search-users
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор пользователя|
|name|`nullable|integer`|Имя пользователя
|phone|`nullable|string`|Номер телефона пользователя
|email|`nullable|integer`|Электронная почта пользователя
|sort_key|`nullable|string`|Столбец для сортировки
|sort_method|`nullable|string`|Метод сортировки

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "nickname": "test123",
            "avatar": null,
            "phone": "89998887766",
            "email": "johndoe@gmail.com",
            "has_subscription": false,
            "status": 1,
            "created_at": "2021-12-30T09:43:18.000000Z",
            "updated_at": "2021-12-30T09:43:18.000000Z",
            "mute": 0,
            "discount": 0
        }
    ],
    "first_page_url": "https://italia/api/admin/users/search-users?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://italia/api/admin/users/search-users?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "https://italia/api/admin/users/search-users?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Вперёд &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "https://italia/api/admin/users/search-users",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```
