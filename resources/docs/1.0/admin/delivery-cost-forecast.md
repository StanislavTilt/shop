- [Создание](#create)
- [Получение](#show)
- [Получение всех](#get-all)
- [Обновление](#update)
- [Удаление](#delete)

<a name="create"></a>
## Создание

### `POST` **Конечная точка**
```text
/admin/delivery-cost-forecast/create
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|region|`required|string`|Регион доставки|
|cost|`required|integer`|Стоимость доставки в регион|



### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "region": "string",
    "cost": "string",
    "id": "integer"
}
```


<a name="show"></a>
## Получение конкретного

### `GET` **Конечная точка**
```text
/admin/delivery-cost-forecast/update/{object_id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "region": "string",
    "cost": "integer",
    "id": "integer"
}
```

<a name="get-all"></a>
## Получение всех категорий

### `GET` **Конечная точка**
```text
/super-admin/admin-account/get-all
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": "integer",
        "region": "string",
        "cost": "integer"
    },
    {
        "id": "integer",
        "region": "string",
        "cost": "integer"
    },
    {
        "id": "integer",
        "region": "string",
        "cost": "integer"
    }
]
```

<a name="update"></a>
## Обновление

### `PUT` **Конечная точка**
```text
/admin/delivery-cost-forecast/update/{object_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|region|`required|string`|Регион доставки|
|cost|`required|integer`|Стоимость доставки в регион|


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": "integer",
    "region": "string",
    "cost": "integer"
}
```

<a name="delete"></a>
## Удаление категории

### `DELETE` **Конечная точка**
```text
/admin/delivery-cost-forecast/delete/{object_id}
```

### Ответ

> {success} Успешный ответ. Код `204`
