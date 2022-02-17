- [Получение корзины](#get-cart)
- [Добавление продукта в корзину](#add-product)
- [Обновление продукта](#update-cart-products)
- [Удаление продукта](#delete-product)

<a name="get-cart"></a>
## Получение корзины <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `GET` **Конечная точка**


```text
/user/cart
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "id": 1,
    "products": [
        {
            "id": 1,
            "quantity": 1,
            "product": {
                "id": 1,
                "name": "Odie Barton DVM",
                "description": "Accusamus est laudantium expedita quo nulla quo. Vel ducimus nihil quae velit veritatis. Vel ullam error aspernatur accusantium. Provident qui velit molestias non sit id velit.",
                "old_price": null,
                "price": "165.00",
                "quantity": 40,
                "features": null,
                "region": null,
                "removal_time": null,
                "brand": {
                    "id": 6,
                    "name": "Shanny Schiller",
                    "logo": "https://via.placeholder.com/120x120.png/004488?text=quia",
                    "is_main": 1,
                    "products_count": null
                },
                "images": {
                    "3aff134a-b124-46da-8e7f-a1b678665319": {
                        "name": "search",
                        "file_name": "search.html",
                        "uuid": "3aff134a-b124-46da-8e7f-a1b678665319",
                        "preview_url": "",
                        "original_url": "http://localhost/storage/products/1/search.html",
                        "order": 1,
                        "custom_properties": [],
                        "extension": "html",
                        "size": 29809
                    }
                }
            },
            "option": {
                "id": 1,
                "color_id": 4,
                "product_id": 1,
                "size": "EU 43",
                "quantity": 5,
                "color": {
                    "id": 4,
                    "name": "MediumAquaMarine",
                    "key": "Ivory",
                    "hex": "#d3de76",
                    "created_at": "2022-01-31 20:11:57",
                    "updated_at": "2022-01-31 20:11:57"
                }
            }
        }
    ]
}
```

<a name="add-product"></a>
## Добавление продукта в корзину <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `PUT` **Конечная точка**
```text
/user/cart/products
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|id|`required|int`|ID добавляемого товара
|quantity|`required|int|min:1`|Кол-во продукта 
|product_option_id|`required|exists:product_options,id`|Характеристика продукта

#### Пример запроса
```json
{
	"id": 2,
	"quantity": 24,
	"product_option_id": 1
}
```


### Ответ

> {success} Успешный ответ. Код `200`

<a name="update-cart-products"></a>
## Обновление продукта

### `PUT` **Конечная точка**
```text
/user/cart/products/{ID}
```

### Тело запроса

|Имя поля|Валидация|Описание|
|:-|:-|:-|
|quantity|`required|int`| Кол-во продукта

### Ответ

> {success} Успешный ответ. Код `204`

<a name="delete-product"></a>
## Удаление продукта <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `DELETE` **Конечная точка**
```text
/user/cart/products/{ID}
```

### Ответ

> {success} Успешный ответ. Код `204`
