- [Обновление токена](#refresh-token)

<a name="refresh-token"></a>
## Обновление токена <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge>

### `POST` **Конечная точка**
```text
/auth/refresh-token
```

### Ответ

> {success} Успешный ответ. Код `200`

```json
{
    "token": "5|QZLXEl8iQiaBmyVmbTLZjItT5RR51m0RxYIF2WKs"
}
```

> {danger} Ответ с ошибкой. Код `401`

```json
{
    "message": "Unauthenticated."
}
```
