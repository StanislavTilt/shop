- [Список продуктов](#get-product-list)
- [Фильтрация брендов](#filters)

<a name="brands"></a>
## Список брендов

### `GET` **Конечная точка**

```text
/brands?include=productsCount|products
```
>> {info} Добавив в строку запроса `include=productsCount|products` вы сможете получить товары (только три) и их кол-во у бренда.

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "Jonathan Kertzmann PhD",
        "logo": "https:\/\/via.placeholder.com\/120x120.png\/0077cc?text=excepturi",
        "is_main": 1,
        "products_count": 1,
        "products": [
            {
                "id": 14,
                "name": "Brando Dooley I",
                "description": "Sed perspiciatis id sit autem unde dignissimos aut. Et hic unde alias quia. Laboriosam tempora et debitis. Reiciendis ut repellendus vel optio et enim.",
                "old_price": "1451.00",
                "price": "23.00",
                "quantity": 26
            }
        ]
    },
    {
        "id": 3,
        "name": "Wallace Powlowski",
        "logo": "https:\/\/via.placeholder.com\/120x120.png\/00ff44?text=laudantium",
        "is_main": 0,
        "products_count": null,
        "products": []
    },
    {
        "id": 4,
        "name": "Mr. Tremaine Doyle",
        "logo": "https:\/\/via.placeholder.com\/120x120.png\/0044ff?text=cum",
        "is_main": 1,
        "products_count": null
    }
]
```

<a name="filters"></a>
## Фильтрация брендов

|Фильтр|Пример|Описание|
|:-|:-|:-|
|main|`filter[main]=true`|Основные бренды
