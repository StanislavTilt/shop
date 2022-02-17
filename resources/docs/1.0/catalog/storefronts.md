- [Список витрин](#storefronts)
- [Получения витрины по ID](#get-storefront-by-id)

<a name="storefronts"></a>
## Список витрин

### `GET` **Конечная точка**


```text
/storefronts
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "title": "Новинки",
        "cover": "https:\/\/source.unsplash.com\/600x600?clothes,shoes",
        "key": "new_items",
        "parameters": [
            {
                "name": "Время жизни товаров",
                "key": "products_lifetime"
            }
        ],
        "products_count": 2
    },
    {
        "id": 2,
        "title": "Предзаказ",
        "cover": "https:\/\/source.unsplash.com\/600x600?clothes,shoes",
        "key": "pre_order",
        "parameters": [],
        "products_count": 0
    }
]
```

<a name="get-storefront-by-id"></a>
## Получения витрины по ID

### `GET` **Конечная точка**


```text
/storefronts/{id}
```


### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "title": "Новинки",
    "cover": "https:\/\/source.unsplash.com\/600x600?clothes,shoes",
    "key": "new_items",
    "parameters": [
        {
            "name": "Время жизни товаров",
            "key": "products_lifetime"
        }
    ],
    "products_count": 2,
    "products": [
        {
            "id": 1,
            "name": "Mr. Weston Carroll DDS",
            "description": "Laborum repellendus voluptatibus eos quidem unde. Et quia ea quam. Maxime vero vel consequatur nam.",
            "old_price": null,
            "price": "652.00",
            "image": "http:\/\/my-italy.loc\/storage\/products\/123\/600x600.jpeg",
            "quantity": 14,
            "tags": []
        },
        {
            "id": 2,
            "name": "Miles Lind Sr.",
            "description": "Accusamus voluptates molestias id architecto dolores. Ullam voluptatibus error aut nemo nam sunt. Eveniet qui occaecati eum iure.",
            "old_price": null,
            "price": "726.00",
            "image": "http:\/\/my-italy.loc\/storage\/products\/153\/600x600.jpeg",
            "quantity": 36,
            "tags": []
        }
    ]
}
```
