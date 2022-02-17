- [Профиль](#profile)
- [Редактирование профиля](#edit-profile)
- [Редактирование адреса](#edit-address)
- [Загрузка аватарки](#upload-avatar)
- [Запрос на изменение номера телефона](#request-change-phone)
- [Подтверждение изменения номера телефона](#validate-change-phone)
- [Изменение пароля](#change-password)
- [Удаление аккаунта пользователя](#delete-account)

<a name="profile"></a>
## Получение данных пользователя <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `GET` **Конечная точка**


```text
/user
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Sheroz",
    "avatar": null,
    "nickname": null,
    "phone": "+7987654321",
    "email": null,
    "status": 2
}
```

<a name="edit-profile"></a>
## Редактирование профиля <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `PUT` **Конечная точка**
```text
/user
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя пользователя
|nickname|`optional|string|min:3|max:12|unique`|Никнейм
|email|`optional|string|unique`|Почта
|country|`required|string`| Страна
|city|`required|string`| Город
|street|`required|string`| Улица
|region|`required|string`| Регион
|flat|`required|string`| Квартира
|postal_code|`required|string`| Почтовый индекс
|lat|`flat`| Широта
|lng|`flat`| Долгота

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Абвгде",
    "avatar": null,
    "nickname": null,
    "phone": "89998887766",
    "email": "cheburek@ya.ru",
    "address": {
        "id": 1,
        "country": "",
        "city": "",
        "street": "123131",
        "region": "",
        "flat": "",
        "postal_code": "",
        "lat": null,
        "lng": null,
        "is_default": null
    }
}
```

> {danger} Ответ с ошибкой. Код `422`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "name": [
            "Обязательно для заполнения."
        ]
    }
}
``` 

<a name="upload-avatar"></a>
## Загрузка аватарки <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/avatar
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|avatar|`required|mimetypes:jpeg,jpg,png|max:2048`| Аватар

### Ответ

> {success} Успешный ответ. Код `201`

```json
{
    "message": "Аватар был успешно загружен."
}
```

> {danger} Ответ с ошибкой. Код `422`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "avatar": [
            "Обязательно для заполнения."
        ]
    }
}
``` 

<a name="request-change-phone"></a>
## Запрос на изменение номера телефона <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/request-change-phone
```

### Ответ

> {success} Успешный ответ. Код `201`

```json
{
    "message": "Запрос на изменение номера телефона успешно отправлен."
}
```

> {danger} Ответ с ошибкой. Код `422`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "avatar": [
            "Обязательно для заполнения."
        ]
    }
}
``` 

<a name="validate-change-phone"></a>
## Подтверждение изменения телефона <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/validate-change-phone
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|new_phone|`required|string|exists:users,phone`| Новый номер телефона
|code|`required|string`| Код подтверждения

### Ответ

> {success} Успешный ответ. Код `201`

```json
{
    "message": "Номер телефона успешно обновлен."
}
```

> {danger} Ответ с ошибкой. Код `422`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "code": [
            "Выбранное значение некорректно."
        ]
    }
}
``` 


<a name="change-password"></a>
## Изменение пароля <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/change-password
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|old_password|`required|string`| Старый пароль пользователя
|new_password|`required|string|min:6|max:32|confirmed`| Новый пароль пользователя
|new_password_confirmation|`required|string|min:6|max:32`| Подтверждение нового пароля

### Ответ

> {success} Успешный ответ. Код `201`

```json
{
    "message": "Пароль успешно обновлен."
}
```


<a name="request-delete-account"></a>
## Запрос на удаление аккаунта <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/delete-account-request
```

### Ответ

> {success} Успешный ответ. Код `201`

```json
{
    "message": "Запрос на удаление успешно отправлен."
}
```


<a name="validate-delete-account"></a>
## Удаление аккаунта пользователя <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/user/validate-delete-account
```
### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|code|`required|string`| Код подтверждения


### Ответ

> {success} Успешный ответ. Код `201`

```json
{
    "message": "Аккаунт успешно удален."
}
```


