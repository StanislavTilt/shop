- [Список категорий](#categories)
- [Фильтрация категорий](#filters-for-categories)
- [Получение категории по id](#category-by-id)

<a name="categories"></a>
## Список категорий
>> {info} Добавив в строку запроса `include=children` вы сможете получить дочерние категории.

### `GET` **Конечная точка**

```text
/categories?include=children&filter[root]=true
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "Женская одежда",
        "slug": "womens-clothing",
        "icon": null,
        "cover": null,
        "parent_id": null,
        "children": [
            {
                "id": 2,
                "name": "Туфли",
                "slug": "shoes",
                "icon": null,
                "cover": null,
                "parent_id": 1,
            }
        ]
    },
    {
        "id": 1,
        "name": "Мужская одежда",
        "slug": "mens-clothing",
        "icon": null,
        "cover": null,
        "parent_id": null,
        "children": []
    }
]
```

<a name="filters-for-categories"></a>
## Фильтрация категорий

|Фильтр|Пример|Описание|
|:-|:-|:-|
|root|`filter[root]=true`|Получение родительских категорий. Например: Женская и Мужская одежда

<a name="category-by-id"></a>
## Получение категории по id

### `GET` **Конечная точка**

```text
/categories/{id}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "name": "Женская одежда",
    "slug": "womens-clothing",
    "icon": null,
    "cover": null,
    "parent_id": null,
    "children": [
        {
            "id": 2,
            "name": "Туфли",
            "slug": "shoes",
            "icon": null,
            "cover": null,
            "parent_id": 1,
            "is_active": 1
        }
    ]
}
```
