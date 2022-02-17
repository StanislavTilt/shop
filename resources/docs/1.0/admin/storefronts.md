- [Создание](#create)
- [Получение](#show)
- [Получение всех](#get-all)
- [Обновление](#update)
- [Удаление](#delete)

<a name="create"></a>
## Создание витрины

### `POST` **Конечная точка**
```text
/admin/storefronts/create
```


### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|title|`required|string`|Имя витрины|
|cover|`required|string`|Иконка категории
|key|`required|string`|Ключ
|parameters|`json`|Параметры

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "title": "title",
    "key": "key",
    "parameters": "{}",
    "changeable": true,
    "updated_at": "2021-12-10T15:23:42.000000Z",
    "created_at": "2021-12-10T15:23:42.000000Z",
    "id": 2
}
```


<a name="show"></a>
## Получение категории

### `GET` **Конечная точка**
```text
/admin/storefronts/show/{id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "title": "Новинки",
    "cover": "https://source.unsplash.com/600x600?clothes,shoes",
    "key": "new_items",
    "parameters": [
        {
            "key": "products_lifetime",
            "name": "Время жизни товаров (в днях)",
            "value": 7
        }
    ],
    "created_at": null,
    "updated_at": null,
    "deletable": 0
}
```

<a name="get-all"></a>
## Получение всех категорий

### `GET` **Конечная точка**
```text
/admin/storefronts/get-all
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "title": "Новинки",
        "cover": "D:\\openserver\\OpenServer\\domains\\italia\\storage\\https://source.unsplash.com/600x600?clothes,shoes",
        "key": "new_items",
        "parameters": [
            {
                "key": "products_lifetime",
                "name": "Время жизни товаров (в днях)",
                "value": 7
            }
        ],
        "products_count": 0
    },
    {
        "id": 2,
        "title": "title",
        "cover": "D:\\openserver\\OpenServer\\domains\\italia\\storage\\storefronts_icons/3b9158457c002ba8213053d196ad67ac.jpg",
        "key": "key",
        "parameters": [
            "json"
        ],
        "products_count": 0
    }
]
```

<a name="update"></a>
## Обновление категории

### `PUT` **Конечная точка**
```text
/admin/storefronts/update/{id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|title|`required|string`|Имя витрины|
|cover|`required|string`|Иконка категории
|key|`required|string`|Ключ
|parameters|`json`|Параметры


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 2,
    "title": "titlelkjhkjhk",
    "cover": null,
    "key": "key",
    "parameters": "{}",
    "created_at": "2021-12-11T11:13:03.000000Z",
    "updated_at": "2021-12-11T11:13:06.000000Z",
    "changeable": 1
}
```

<a name="delete"></a>
## Удаление категории

### `DELETE` **Конечная точка**
```text
/admin/storefronts/destroy/{id}
```

### Ответ

> {success} Успешный ответ. Код `204`
