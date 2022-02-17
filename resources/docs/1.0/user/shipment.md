- [Получить точки доставки](#get-points)

<a name="get-points"></a>
## Получение всех точек доставки по городу пользователя <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `GET` **Конечная точка**


```text
/user/shipment/get-delivery-points
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "Pvz": {
        "@attributes": {
            "Code": "KIYE3",
            "Status": "ACTIVE",
            "PostalCode": "02000",
            "Name": "Мармелад",
            "CountryCode": "47",
            "countryCodeIso": "UA",
            "CountryName": "Украина",
            "RegionCode": "515",
            "RegionName": "Киевская обл.",
            "CityCode": "7870",
            "City": "Киев",
            "WorkTime": "Пн-Пт 09:00-18:00",
            "Address": "ул. Борщаговская, 154",
            "FullAddress": "Украина, Киевская обл., Киев, ул. Борщаговская, 154",
            "AddressComment": "",
            "Phone": "+380443449845, +380675221075",
            "Email": "kiev@cdek.ru",
            "Note": "",
            "coordX": "30.443456",
            "coordY": "50.446415",
            "Type": "PVZ",
            "ownerCode": "cdek",
            "IsDressingRoom": "true",
            "HaveCashless": "true",
            "HaveCash": "true",
            "AllowedCod": "false",
            "TakeOnly": "false",
            "IsHandout": "true",
            "IsReception": "true",
            "NearestStation": "Индустриальный мост",
            "MetroStation": "",
            "Site": "",
            "Fulfillment": "false"
        },
        "PhoneDetail": [
            {
                "@attributes": {
                    "number": "+380443449845"
                }
            },
            {
                "@attributes": {
                    "number": "+380675221075"
                }
            }
        ],
        "OfficeImage": [
            {
                "@attributes": {
                    "url": "https://pvzimage.cdek.ru/images/7799/27241_image"
                }
            },
            {
                "@attributes": {
                    "url": "https://pvzimage.cdek.ru/images/7799/27243_image"
                }
            }
        ],
        "WorkTimeY": [
            {
                "@attributes": {
                    "day": "1",
                    "periods": "09:00/18:00"
                }
            },
            {
                "@attributes": {
                    "day": "2",
                    "periods": "09:00/18:00"
                }
            },
            {
                "@attributes": {
                    "day": "3",
                    "periods": "09:00/18:00"
                }
            },
            {
                "@attributes": {
                    "day": "4",
                    "periods": "09:00/18:00"
                }
            },
            {
                "@attributes": {
                    "day": "5",
                    "periods": "09:00/18:00"
                }
            }
        ]
    }
}
```
