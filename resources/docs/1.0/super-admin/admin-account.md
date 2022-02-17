- [Создание администатора](#create)
- [Получение администратора](#show)
- [Получение всех администраторов](#get-all)
- [Обновление администратора](#update)
- [Сброс пароля администаратора](#regenerate-password)
- [Удаление администаратора](#delete)

<a name="create"></a>
## Создание администратора

### `POST` **Конечная точка**
```text
/super-admin/admin-account/create
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|nickname|`required|string|unique:admins,nickname`|Логин пользователя|
|phone|`required|string`|Номер телефона
|password|`required|string|min:8|max:32`|Пароль
|password_confirmation|`required|string|min:8|max:32`|Подтверждение пароля
|name|`required|string`|Полное имя пользователя
|role|`required|string`|Роль администратора
|email|`required|string|email`|Электронная почта пользователя


### Ответ

> {success} Успешный ответ. Код `200`


<a name="admins-search"></a>
## Получение администратора

### `POST` **Конечная точка**
```text
/super-admin/admin-account/search-admins
```


### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор администратора
|name|`nullable|string`|Имя администратора
|phone|`nullable|string`|Номер телефона
|email|`nullable|string`|Почта администратора
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
            "name": "test",
            "nickname": "test",
            "phone": "test",
            "email": "test@email.com",
            "role": "super-admin",
            "product_create_count": 0,
            "status": "active",
            "created_at": "2021-12-28T17:15:25.000000Z",
            "updated_at": "2021-12-28T17:15:25.000000Z",
            "avatar": ""
        }
    ],
    "first_page_url": "https://italia/api/super-admin/admin-account/search-admins?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://italia/api/super-admin/admin-account/search-admins?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "https://italia/api/super-admin/admin-account/search-admins?page=1",
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
    "path": "https://italia/api/super-admin/admin-account/search-admins",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

<a name="show"></a>
## Получение администратора

### `GET` **Конечная точка**
```text
/super-admin/admin-account/show/{user_id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "admin": {
        "id": 2,
        "name": "test name",
        "nickname": "test123",
        "phone": "test phone",
        "email": "email@mail.com",
        "role": "admin",
        "product_create_count": 0,
        "status": "active",
        "created_at": "2021-12-28T16:02:35.000000Z",
        "updated_at": "2021-12-28T16:02:35.000000Z",
        "avatar": "admin_avatars/6ba9767ccb8636e5585bf5e56c5e67cf.png"
    },
    "admin_products": {
        "current_page": 1,
        "data": [],
        "first_page_url": "https://italia/api/super-admin/admin-account/show/2?page=1",
        "from": null,
        "last_page": 1,
        "last_page_url": "https://italia/api/super-admin/admin-account/show/2?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Назад",
                "active": false
            },
            {
                "url": "https://italia/api/super-admin/admin-account/show/2?page=1",
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
        "path": "https://italia/api/super-admin/admin-account/show/2",
        "per_page": 5,
        "prev_page_url": null,
        "to": null,
        "total": 0
    }
}
```

<a name="get-all"></a>
## Получение всех администраторов

### `GET` **Конечная точка**
```text
/super-admin/admin-account/get-all
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "test",
        "nickname": "test",
        "phone": "test",
        "email": "test",
        "role": "super-admin",
        "product_create_count": 0,
        "status": "active"
    },
    {
        "id": 2,
        "name": "test name",
        "nickname": "test123",
        "phone": "test phone",
        "email": "email@mail.com",
        "role": "admin",
        "product_create_count": 0,
        "status": "active"
    }
]
```

<a name="update"></a>
## Обновление администратора

### `PUT` **Конечная точка**
```text
/super-admin/admin-account/update/{user_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|nickname|`string`|Имя пользователя телефона|
|phone|`string`|Номер телефона
|name|`string`|Полное имя пользователя
|role|`string`|Роль администратора
|email|`string|email`|Электронная почта пользователя
|active|`boolean`|Активирована ли учетная запись


### Ответ

> {success} Успешный ответ. Код `200`



<a name="regenerate-password"></a>
## Сброс пароля администратора

### `GET` **Конечная точка**
```text
/super-admin/admin-account/regenerate-password/{user_id}
```

Новый пароль приходит в ответе на запрос администратору который его выполнил.

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "data": {
        "id": 2,
        "name": "test name",
        "nickname": "test123",
        "phone": "test phone",
        "email": "email@mail.com",
        "role": "admin",
        "product_create_count": 0,
        "status": "active"
    },
    "password": "65a0e3d3"
}
```

<a name="delete"></a>
## Удаление администратора

### `DELETE` **Конечная точка**
```text
/super-admin/admin-account/delete/{user_id}
```

### Ответ

> {success} Успешный ответ. Код `204`


<a name="get-admin-roles"></a>
## Получение всех ролей

### `GET` **Конечная точка**
```text
/super-admin/admin-account/get-admin-roles
```

### Ответ
```json
[
    "admin",
    "super-admin"
]
```

> {success} Успешный ответ. Код `200`
