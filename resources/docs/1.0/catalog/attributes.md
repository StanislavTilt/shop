- [Список атрибутов продукта](#get-product-attributes)

<a name="get-product-attributes"></a>

## Список атрибутов продукта

### `GET` **Конечная точка**

```text
/attributes
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
[
    {
        "id": 1,
        "name": "Размеры",
        "type": "multiselect",
        "order": 0,
        "key": "size",
        "options": [
            {
                "id": 1,
                "name": "XS",
                "value": null
            },
            {
                "id": 2,
                "name": "S",
                "value": null
            },
            {
                "id": 3,
                "name": "M",
                "value": null
            },
            {
                "id": 4,
                "name": "L",
                "value": null
            },
            {
                "id": 5,
                "name": "XL",
                "value": null
            }
        ]
    },
    {
        "id": 2,
        "name": "Цвет",
        "type": "multiselect",
        "order": 1,
        "key": "color",
        "options": [
            {
                "id": 6,
                "name": "Белый",
                "value": "#ffffff"
            },
            {
                "id": 7,
                "name": "Морской",
                "value": "#43F2E8"
            },
            {
                "id": 8,
                "name": "Бежевый",
                "value": "#FFF4F2"
            }
        ]
    }
]
```
