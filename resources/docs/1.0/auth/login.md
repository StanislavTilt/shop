- [Вход](#login)
- [Выход](#logout)

<a name="login"></a>
## Вход

### `POST` **Конечная точка**
```text
/auth/login
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|phone|`required|string`|Номер телефона|
|password|`required|string|min:8|max:20`|Пароль|
|device_name|`required|string`|Название телефона с которого входят|
|device_key|`nullable|string`|Ключ девайса|

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
  "expires_in"    : "integer",
  "access_token"  : "string|token",
  "refresh_token" : "string|token"
}
```

> {danger} Ответ с ошибкой. Код `401`

Причина `отправление данные не совпадают с данными в БД`

```json
{
    "message": "Неверное имя пользователя или пароль.",
    "errors": {
        "error": [
            "Неверное имя пользователя или пароль."
        ]
    }
}
```

<a name="logout"></a>
## Выход

### `POST` **Конечная точка**
```text
/auth/logout
```

### Ответ

> {success} Успешный ответ. Код `204`
