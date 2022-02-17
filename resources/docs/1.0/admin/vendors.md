- [Поиск](#search)
- [Создание](#create)
- [Обновление](#update)
- [Получение конкретного](#show)


<a name="create"></a>
## Создание поставщика

### `POST` **Конечная точка**
```text
/admin/vendors
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя Поставщика
|is_active|`required|boolean`|Его пометка активности



### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "name": "name123",
    "is_active": "1",
    "id": 21
}
```

<a name="search"></a>
## Поиск поставщиков

### `POST` **Конечная точка**
```text
/admin/vendors/search
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор поставщика
|name|`nullable|integer`|Имя поставщика
|is_active|`nullable|boolean`|Активность поставщика
|sort_key|`nullable|string`|Столбец для сортировки
|sort_method|`nullable|string`|Метод сортировки


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 21,
            "name": "name123",
            "is_active": 1
        }
    ],
    "first_page_url": "https://italia/api/admin/vendors/search?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "https://italia/api/admin/vendors/search?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "https://italia/api/admin/vendors/search?page=1",
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
    "path": "https://italia/api/admin/vendors/search",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

<a name="show"></a>
## Получение поставщика

### `POST` **Конечная точка**
```text
/admin/vendors/{vendor_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "name": "name123",
    "is_active": "1",
    "id": 21
}
```

<a name="update"></a>
## Обновление поставщика

### `PUT` **Конечная точка**
```text
/admin/vendors/{vendor_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`nullable|string`|Имя Поставщика
|is_active|`nullable|boolean`|Его пометка активности

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "name": "name123",
    "is_active": "1",
    "id": 21
}
```


