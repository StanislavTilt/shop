- [Поиск](#search)
- [Создание](#create)
- [Обновление](#update)
- [Получение конкретного](#show)


<a name="send-psuh"></a>
## Отправление пуша

### `POST` **Конечная точка**
```text
/admin/push-message/send-push
```

### Тело запроса {json}


|Имя поля|Валидация|Описание|
|:-|:-|:-|
|type_key|`required|string`|Ключ события
|object_id|`required|string`|Идентификатор обьекта к которому привязано событие
|title|`required|string`|Заголовок
|body|`required|string`|Текст

### Ответ

> {success} Успешный ответ. Код `200`

<a name="get-types"></a>
## Получение типов пушей

### `GET` **Конечная точка**
```text
/admin/push-message/get-types
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 3,
        "key": "order-history",
        "name": "что то история заказов"
    },
    {
        "id": 4,
        "key": "cart",
        "name": "что то корзина"
    },
    {
        "id": 5,
        "key": "product_detail",
        "name": "что то конкретный продукт"
    },
    {
        "id": 6,
        "key": "storefront-products",
        "name": "продукты витрины"
    },
    {
        "id": 7,
        "key": "brand-products",
        "name": "продукты бренда"
    },
    {
        "id": 8,
        "key": "products-by-categories",
        "name": "продукты категории"
    }
]
```
