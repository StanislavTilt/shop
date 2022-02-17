- [Список рекламных акций](#promotions)
- [Получение рекламной акции по ID](#get-promotion-by-id)

<a name="promotions"></a>

## Список рекламных акций

### `GET` **Конечная точка**

```text
/promotions
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "title": "modi",
        "image": "http:\/\/my-italy.loc\/aliquam",
        "description": "description",
        "percent": 34,
        "from_date": "2021-08-19T22:27:02.000000Z",
        "to_date": "2021-08-26T22:27:02.000000Z"
    },
    {
        "id": 2,
        "title": "eum",
        "image": "http:\/\/my-italy.loc\/sit",
        "description": "description",
        "percent": 65,
        "from_date": "2021-08-19T22:27:03.000000Z",
        "to_date": "2021-08-26T22:27:03.000000Z"
    },
    {
        "id": 3,
        "title": "quia",
        "image": "http:\/\/my-italy.loc\/veritatis",
        "description": "description",
        "percent": 24,
        "from_date": "2021-08-19T22:27:03.000000Z",
        "to_date": "2021-08-26T22:27:03.000000Z"
    }
]
```

<a name="get-promotion-by-id"></a>

## Получение рекламной акции по ID

```text
/promotions/{ID}
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "title": "qui",
    "image": "https://italia/storage/https://via.placeholder.com/640x480.png/0044cc?text=non",
    "description": "description",
    "percent": 33,
    "from_date": "2022-02-15T09:42:16.000000Z",
    "to_date": "2022-02-22T09:42:16.000000Z",
    "products": [
        {
            "id": 1,
            "promotion_id": 1,
            "product_id": 47,
            "product": {
                "id": 47,
                "name": "Alyce Willms",
                "description": "Iste rem voluptatem ducimus ut sapiente. Vitae quasi est corrupti magni laborum consequatur excepturi.",
                "old_price": null,
                "price": "416.00",
                "image": "http://localhost/storage/products/47/search.html",
                "quantity": 74,
                "tags": [],
                "brand": {
                    "id": 10,
                    "name": "Louisa Skiles DVM",
                    "logo": "https://via.placeholder.com/120x120.png/000011?text=facere",
                    "is_main": 1,
                    "products_count": null
                },
                "categories": [
                    {
                        "id": 47,
                        "category_id": 47,
                        "product_id": 47,
                        "category": {
                            "id": 13,
                            "name": "unde",
                            "icon": "https://italia/storage/https://via.placeholder.com/120x120.png/008855?text=clothes+vector+consequatur",
                            "cover": null,
                            "order": 3,
                            "parent_id": null
                        }
                    }
                ]
            }
        }
    ]
}
```
