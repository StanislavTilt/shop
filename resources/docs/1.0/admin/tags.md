- [Получение всех](#get-all)
- [Поиск](#search)
- [Создание](#create)
- [Обновление](#update)
- [Получение конкретного](#show)
- [Удаление](#destroy)


<a name="create"></a>
## Создание тега

### `POST` **Конечная точка**
```text
/admin/tags
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|title|`required|string`|Имя тега
|key|`required|string`|Ключ тега
|order|`required|integer`|Нумерация



### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "title": "asdasd",
    "key": "title1",
    "order": "1",
    "id": 6
}
```

<a name="search"></a>
## Поиск брендов

### `POST` **Конечная точка**
```text
/admin/tags/search
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор тега
|title|`nullable|integer`|Имя тега
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
            "title": "Акция",
            "key": "stock",
            "order": 0
        },
        {
            "id": 2,
            "title": "Скидка",
            "key": "discount",
            "order": 1
        },
        {
            "id": 3,
            "title": "Хит",
            "key": "hit",
            "order": 2
        },
        {
            "id": 4,
            "title": "Заканчивается",
            "key": "stockout",
            "order": 3
        },
        {
            "id": 5,
            "title": "Уже в России",
            "key": "already-in-russia",
            "order": 3
        },
        {
            "id": 6,
            "title": "asdasd",
            "key": "title1",
            "order": 1
        }
    ],
    "first_page_url": "https://italia/api/admin/tags/search?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://italia/api/admin/tags/search?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "https://italia/api/admin/tags/search?page=1",
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
    "path": "https://italia/api/admin/tags/search",
    "per_page": 10,
    "prev_page_url": null,
    "to": 6,
    "total": 6
}
```

<a name="show"></a>
## Получение тега

### `GET` **Конечная точка**
```text
/admin/tags/{brand_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "title": "Акция",
    "key": "stock",
    "order": 0
}
```

<a name="update"></a>
## Обновление брендов

### `PUT` **Конечная точка**
```text
/admin/tags/{vendor_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|title|`nullable|string`|Имя тега
|key|`nullable|string`|Ключ тега
|order|`nullable|integer`|Порядок тега

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "title": "1231",
    "key": "stock",
    "order": 0
}
```

<a name="destroy"></a>
## Удаление

### `DELETE` **Конечная точка**
```text
/admin/tags/{tag_id}
```


### Ответ

> {success} Успешный ответ. Код `200`



