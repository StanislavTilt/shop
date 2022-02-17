- [Создание](#create)
- [Получение](#show)
- [Получение всех](#get-all)
- [Обновление](#update)
- [Удаление](#delete)

<a name="create"></a>
## Создание категории

### `POST` **Конечная точка**
```text
/admin/category/create
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`required|string`|Имя категории|
|icon|`required|string`|Иконка категории
|cover|`required|string`|Оценочный вес
|is_active|`boolean`|Видимость
|order|`required|string`|Порядок
|parent_id|`integer|exists:categories,id`|Идентификатор родительской категории


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": "integer|id",
    "name": "string",
    "slug": "string",
    "icon": "string",
    "cover": "string",
    "order": "string",
    "parent_id": "integer"
}
```


<a name="show"></a>
## Получение категории

### `GET` **Конечная точка**
```text
/admin/category/show/{category_id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": "integer|id",
    "name": "string",
    "slug": "string",
    "icon": "string",
    "cover": "string",
    "order": "string",
    "parent_id": "integer"
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
        "id": "integer|id",
        "name": "string",
        "slug": "string",
        "icon": "string",
        "cover": "string",
        "order": "string",
        "parent_id": "integer"
    },
    {
        "id": "integer|id",
        "name": "string",
        "slug": "string",
        "icon": "string",
        "cover": "string",
        "order": "string",
        "parent_id": "integer"
    }
]
```

<a name="update"></a>
## Обновление категории

### `PUT` **Конечная точка**
```text
/admin/category/update/{category_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|name|`string`|Имя категории|
|icon|`string`|Иконка категории
|cover|`string`|Оценочный вес
|is_active|`boolean`|Видимость
|order|`string`|Порядок
|parent_id|`integer|exists:categories,id`|Идентификатор родительской категории
|email|`string|email`|Электронная почта пользователя


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": "integer|id",
    "name": "string",
    "slug": "string",
    "icon": "string",
    "cover": "string",
    "order": "string",
    "parent_id": "integer"
}
```

<a name="delete"></a>
## Удаление категории

### `DELETE` **Конечная точка**
```text
/admin/category/destroy/{category_id}
```

### Ответ

> {success} Успешный ответ. Код `204`
