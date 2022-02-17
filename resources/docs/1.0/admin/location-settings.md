- [Обновление настроек локации](#update)
- [Получение всех настроек локации](#index)
- [Получение конкретной настройки](#show)
- [Получение всех локаций](#get-locations)

<a name="update"></a>
## Обновление настроек локации

### `POST` **Конечная точка**
```text
/admin/location-settings/update
```

### Тело запроса {json}

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|location_id|`required|integer|exists:locations,id`|Идентификатор локации|
|kilogram_price|`nullable|numeric`|Стоимость килограмма доставки|
|allowance|`nullable|numeric`|Региональная надбавка|


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "location_id": 1,
    "kilogram_price": "11",
    "allowance": "11"
}
```

<a name="index"></a>
## Получение всех настроек локации

### `GET` **Конечная точка**
```text
/admin/location-settings
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "location_id": 1,
        "kilogram_price": 19,
        "allowance": 17,
        "location": {
            "id": 1,
            "name": "Европа",
            "code": "EU",
            "currency_code": "EUR"
        }
    },
    {
        "id": 2,
        "location_id": 2,
        "kilogram_price": 18,
        "allowance": 22,
        "location": {
            "id": 2,
            "name": "Америка",
            "code": "USA",
            "currency_code": "USD"
        }
    }
]
```

<a name="show"></a>
## Получение конкретной настройки

### `GET` **Конечная точка**
```text
/admin/location-settings/{location_setting_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "location_id": 1,
    "kilogram_price": 19,
    "allowance": 17,
    "location": {
        "id": 1,
        "name": "Европа",
        "code": "EU",
        "currency_code": "EUR"
    }
}
```

<a name="get-locations"></a>
## Получение всех локаций

### `GET` **Конечная точка**
```text
/admin/location-settings/get-locations
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "Европа",
        "code": "EU",
        "currency_code": "EUR"
    },
    {
        "id": 2,
        "name": "Америка",
        "code": "USA",
        "currency_code": "USD"
    }
]
```
