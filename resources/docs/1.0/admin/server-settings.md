- [Получение всех настроек](#get-all-settings)
- [Обновление наценки конвертации](#update-conversion-commission)

<a name="update-conversion-commission"></a>
## Обновление наценки конвертации

### `POST` **Конечная точка**
```text
/admin/server-settings/update/conversion-commission
```

### Тело запроса {json}

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|commission|`required|numeric`|Наценка конвертации|


### Ответ

> {success} Успешный ответ. Код `200`

<a name="get-all-settings**"></a>
## Получение всех настроек

### `GET` **Конечная точка**
```text
/admin/server-settings/get-all
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "Время удаления архивных продуктов в днях",
        "key": "archive_removal_days",
        "value": "90"
    },
    {
        "id": 2,
        "name": "Время жизни кода подтверждения в секундах",
        "key": "validation_request_lifetime",
        "value": "60"
    },
    {
        "id": 3,
        "name": "Комиссия за конвертацию валюты в процентах",
        "key": "currency_conversion_commission",
        "value": "0.04"
    }
]
```


