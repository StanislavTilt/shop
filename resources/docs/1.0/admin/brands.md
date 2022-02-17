- [Получение всех](#get-all)
- [Поиск](#search)
- [Создание](#create)
- [Обновление](#update)
- [Получение конкретного](#show)
- [Удаление](#destroy)


<a name="create"></a>
## Создание бренда

### `POST` **Конечная точка**
```text
/admin/brands
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя бренда
|logo|`required|boolean`|Аватарка бренда ссылкой
|is_active|`required|boolean`|Пометка активности бренда
|is_main|`required|boolean`|Пометка основного 



### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "name": "1231231",
    "logo": "https://b1.filmpro.ru/c/444776.1200xp.jpg",
    "is_active": "1",
    "is_main": "1",
    "id": 17
}
```

<a name="search"></a>
## Поиск брендов

### `POST` **Конечная точка**
```text
/admin/brands/search
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`nullable|integer`|Идентификатор бренда
|name|`nullable|integer`|Имя бренда
|is_active|`nullable|boolean`|Активность бренда
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
            "name": "Melissa Mueller",
            "logo": "https://via.placeholder.com/120x120.png/0011ff?text=vitae",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 2,
            "name": "Mr. Samson Muller",
            "logo": "https://via.placeholder.com/120x120.png/0077ee?text=numquam",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 3,
            "name": "Mr. Lawrence Rohan PhD",
            "logo": "https://via.placeholder.com/120x120.png/003377?text=commodi",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 4,
            "name": "Prof. Roberta Nicolas",
            "logo": "https://via.placeholder.com/120x120.png/001133?text=molestiae",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 5,
            "name": "Felicity Ward DDS",
            "logo": "https://via.placeholder.com/120x120.png/009922?text=et",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 6,
            "name": "Prof. Emory Cummerata I",
            "logo": "https://via.placeholder.com/120x120.png/00ddff?text=perspiciatis",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 7,
            "name": "Deron Jast",
            "logo": "https://via.placeholder.com/120x120.png/001133?text=labore",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 8,
            "name": "Miss Ashtyn Bode MD",
            "logo": "https://via.placeholder.com/120x120.png/001166?text=nesciunt",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 9,
            "name": "Jay Lubowitz",
            "logo": "https://via.placeholder.com/120x120.png/002266?text=aut",
            "is_active": 1,
            "is_main": 1
        },
        {
            "id": 10,
            "name": "Dale Greenfelder DVM",
            "logo": "https://via.placeholder.com/120x120.png/008899?text=assumenda",
            "is_active": 1,
            "is_main": 1
        }
    ],
    "first_page_url": "https://italia/api/admin/brands/search?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "https://italia/api/admin/brands/search?page=2",
    "links": [
        {
            "url": null,
            "label": "&laquo; Назад",
            "active": false
        },
        {
            "url": "https://italia/api/admin/brands/search?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": "https://italia/api/admin/brands/search?page=2",
            "label": "2",
            "active": false
        },
        {
            "url": "https://italia/api/admin/brands/search?page=2",
            "label": "Вперёд &raquo;",
            "active": false
        }
    ],
    "next_page_url": "https://italia/api/admin/brands/search?page=2",
    "path": "https://italia/api/admin/brands/search",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 17
}
```

<a name="show"></a>
## Получение бренда

### `GET` **Конечная точка**
```text
/admin/brands/{brand_id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Melissa Mueller",
    "logo": "https://via.placeholder.com/120x120.png/0011ff?text=vitae",
    "is_active": 1,
    "is_main": 1
}
```

<a name="update"></a>
## Обновление брендов

### `PUT` **Конечная точка**
```text
/admin/brands/{vendor_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`nullable|string`|Имя бренда
|logo|`nullable|string`|Лого бренда
|is_active|`nullable|boolean`|Активность бренда
|is_main|`nullable|boolean`|

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "12312",
    "logo": "https://via.placeholder.com/120x120.png/0011ff?text=vitae",
    "is_active": 1,
    "is_main": 1
}
```

