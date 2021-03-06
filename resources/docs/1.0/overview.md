# Работа с API

Эта документация призвана предоставить всю информацию необходимую для работы с API Моя Италия.

---


- [Доступ к API](#verifying-auth-request)
- [Проверка подлинности запросов](#verifying-auth-request)

<a name="section-1"></a>
## Доступ к API

Весь доступ к API осуществляется по протоколу HTTP (в последующем будет заменён на HTTPS) и осуществляется по адресу
```text 
http://45.67.59.194/api
``` 
Все данные отправляются и принимаются в формате JSON.

<a name="section-1"></a>
## Проверка подлинности запросов

Для работы с API, которым нужно участие пользователя, требуется подтвердить подлинность запроса. В таких запросах нужно добавить заголовок авторизации со значением `Bearer {TOKEN}`. Его можно получить после [аутентификации](auth/login#login) или [верификации](auth/verification#verification) номера телефона. А все конечные точки, которым требуется проверка подлинности отмечены значком <larecipe-badge type="primary" circle icon="fa fa-lock"></larecipe-badge> в документации.

