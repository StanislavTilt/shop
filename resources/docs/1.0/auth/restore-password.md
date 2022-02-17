- [Запрос на восстановление](#restore-request)
- [Подтверждение восстановления](#restore)

<a name="restore-request"></a>
## Запрос восстановления

### `POST` **Конечная точка**
```text
/auth/restore-request
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|phone|`required|string|exists:users,phone`|Номер телефона пользователя|


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "message": "success"
}
```

> {danger} Ответ с ошибкой. Код `401`

Причина `отправление данные не совпадают с данными в БД`

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
Причина `Учетная запись пользователя являеться администратором`

```json
{
    "message": "Восстановление пароля доступно только обычным пользователям.",
    "errors": {
        "error": [
            "Восстановление пароля доступно только обычным пользователям."
        ]
    }
}
```

Причина `Учетная запись администратора неактивна (active = false)`

```json
{
    "message": "Данный пользователь отключен.",
    "errors": {
        "error": [
            "Данный пользователь отключен."
        ]
    }
}
```

<a name="restore"></a>
## Восстановление доступа   

### `POST` **Конечная точка**
```text
/auth/restore
```


### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|phone|`required|string|exists:users,phone`|Номер телефона пользователя|
|code|`required|string|exists:restore_requests,code`|Код восстановления|
|password|`required|string|min:6|max:32|confirmed`|Новый пароль|
|password_confirmation|`required|string|exists:users,phone`|Подтверждение нового пароля|


### Ответ

> {success} Успешный ответ. Код `204`
```json
{
    "data": {
        "id": "integer",
        "name": "string",
        "avatar": "string",
        "nickname": "string",
        "phone": "string",
        "email": "string",
        "address": null
    },
    "token": "1|OyzdHCe6WWpHDc1326wXqTBpFcM3PRjjHtFyzM7w"
}
```

Причина `отправление данные не совпадают с данными в БД`

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
