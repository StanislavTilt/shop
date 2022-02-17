- [Регистрация](#register)

<a name="register"></a>
## Регистрация

> {info} После успешной регистрации пользователя, нужно верифицировать его. О том как это сделать, можете узнать в разделе [Верификация](verification) 

### `POST` **Конечная точка**
```text
/auth/register
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя пользователя
|phone|`required|string`|Номер телефона
|password|`required|string|min:8|max:20`|Пароль
|password_confirmation|`required|string|min:8|max:20`|Подтверждение пароля
|device_key|`nullable|string`|Ключ девайса|


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "message": "Код подтверждения отправлен на номер телефона"
}
```
    
> {danger} Ответ с ошибкой. Код `422`

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "phone": [
            "The phone has already been taken."
        ]
    }
}
```

