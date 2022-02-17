- [Поиск](#search)
- [Создание](#create)
- [Обновление](#update)
- [Получение конкретного](#show)


<a name="create"></a>
## Создание цвета

### `POST` **Конечная точка**
```text
/admin/colors
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя цвета
|key|`required|string`|Ключ цвета
|hex|`required|string|hex`|Цвет в хексе



### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "name": "Красный",
    "key": "red",
    "hex": "#FF0000",
    "id": 7
}
```

<a name="search"></a>
## Поиск цвета

### `POST` **Конечная точка**
```text
/admin/colors/search
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`nullable|integer`|Имя цвета
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
            "name": "Blue",
            "key": "Blue",
            "hex": "#ce0634",
            "created_at": "2022-01-31 10:57:39",
            "updated_at": "2022-01-31 10:57:39"
        },
        {
            "id": 2,
            "name": "SeaShell",
            "key": "DodgerBlue",
            "hex": "#7a7495",
            "created_at": "2022-01-31 10:57:39",
            "updated_at": "2022-01-31 10:57:39"
        },
        {
            "id": 3,
            "name": "MediumBlue",
            "key": "Khaki",
            "hex": "#37efba",
            "created_at": "2022-01-31 10:57:39",
            "updated_at": "2022-01-31 10:57:39"
        },
        {
            "id": 4,
            "name": "Blue",
            "key": "ForestGreen",
            "hex": "#c48f67",
            "created_at": "2022-01-31 10:57:39",
            "updated_at": "2022-01-31 10:57:39"
        },
        {
            "id": 5,
            "name": "Crimson",
            "key": "Darkorange",
            "hex": "#6dc031",
            "created_at": "2022-01-31 10:57:39",
            "updated_at": "2022-01-31 10:57:39"
        },
        {
            "id": 6,
            "name": "name",
            "key": "key",
            "hex": "#FFFFFF",
            "created_at": null,
            "updated_at": null
        },
        {
            "id": 7,
            "name": "Красный",
            "key": "red",
            "hex": "#FF0000",
            "created_at": null,
            "updated_at": null
        }
    ],
    "first_page_url": "https://italia/api/admin/colors/search?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://italia/api/admin/colors/search?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "https://italia/api/admin/colors/search?page=1",
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
    "path": "https://italia/api/admin/colors/search",
    "per_page": 10,
    "prev_page_url": null,
    "to": 7,
    "total": 7
}
```

<a name="show"></a>
## Получение цвета

### `POST` **Конечная точка**
```text
/admin/colors/{color_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Blue",
    "key": "Blue",
    "hex": "#ce0634",
    "created_at": "2022-01-31 10:57:39",
    "updated_at": "2022-01-31 10:57:39"
}
```

<a name="update"></a>
## Обновление цвета

### `PUT` **Конечная точка**
```text
/admin/colors/{color_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`nullable|string`|Имя цвета
|key|`nullable|string`|Ключ цвета
|hex|`nullable|string`|Хекс цвета

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "name",
    "key": "key",
    "hex": "#999999",
    "created_at": "2022-01-31 10:57:39",
    "updated_at": "2022-01-31 10:57:39"
}
```


