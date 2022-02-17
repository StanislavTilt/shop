- [Создание](#create)
- [Получение](#show)
- [Получение всех](#get-all)
- [Обновление](#update)
- [Удаление](#delete)

<a name="create"></a>
## Создание 

### `POST` **Конечная точка**
```text
/admin/bad-words/create
```

### Тело запроса


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|bad_word|`required|string`|Слово которое следует заменить|
|replace_word|`required|string`|Слово которым следует заменить|



### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "bad_word": "string",
    "replace_word": "string",
    "id": "integer"
}
```


<a name="show"></a>
## Получение конкретного

### `GET` **Конечная точка**
```text
/admin/bad-words/show/{bad_word_id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "bad_word": "string",
    "replace_word": "string",
    "id": "integer"
}
```

<a name="get-all"></a>
## Получение всех

### `GET` **Конечная точка**
```text
/admin/bad-words/get-all
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": "integer",
        "bad_word": "string",
        "replace_word": "string"
    },
    {
        "id": "integer",
        "bad_word": "string",
        "replace_word": "string"
    }
]
```

<a name="update"></a>
## Обновление категории

### `PUT` **Конечная точка**
```text
/admin/bad-words/update/{bad_word_id}
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|bad_word|`required|string`|Слово которое следует заменить|
|replace_word|`required|string`|Слово которым следует заменить|


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "bad_word": "string",
    "replace_word": "string",
    "id": "integer"
}
```

<a name="delete"></a>
## Удаление категории

### `DELETE` **Конечная точка**
```text
/admin/bad-words/delete/{bad_word_id}
```

### Ответ

> {success} Успешный ответ. Код `204`
