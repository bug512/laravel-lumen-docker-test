---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Create participant


<!-- START_81e54b82c4c02df20fa6ea34aec65a27 -->
## Добавление участника

> Example request:

```bash
curl -X POST \
    "http://localhost/api/participants" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"action":"fugiat","data":{"name":"ea","email":"libero","even_id":18}}'

```

```javascript
const url = new URL(
    "http://localhost/api/participants"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "action": "fugiat",
    "data": {
        "name": "ea",
        "email": "libero",
        "even_id": 18
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/participants`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `action` | string |  required  | Обязательный параметр `create`
        `data.name` | string |  optional  | Имя участника
        `data.email` | string |  optional  | Email участника
        `data.even_id` | integer |  optional  | id мероприятия
    
<!-- END_81e54b82c4c02df20fa6ea34aec65a27 -->

#Delete participant


<!-- START_f5cfce2858b1e5067c374982b22d2582 -->
## Удаление участника

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/participants/dolor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/participants/dolor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Успешно удалено"
}
```
> Example response (504):

```json
{
    "id": 2,
    "status": 504,
    "title": "Ошибка удаления"
}
```
> Example response (504):

```json
{
    "id": 3,
    "status": 504,
    "title": "Участник не найден"
}
```

### HTTP Request
`DELETE api/participants/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id участника обязательный параметр .

<!-- END_f5cfce2858b1e5067c374982b22d2582 -->

#Participants list


<!-- START_31bf5425994bd5ced1a5fc12e8bc91df -->
## Список участников
Список участников с возможностью фильтрации

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/participants[/event/minima]" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/participants[/event/minima]"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "name": "Arnaldo Nolan",
            "email": "dach.patience@price.com",
            "event": {
                "id": 8,
                "title": "Separating Machine Operators",
                "date": "2001-01-05",
                "city": "Lake Vida",
                "created_at": "2020-07-06T19:39:51.000000Z",
                "updated_at": "2020-07-06T19:39:51.000000Z"
            },
            "created_at": null,
            "updated_at": null
        },
        {
            "id": null,
            "name": "Oscar Krajcik",
            "email": "lebsack.wyatt@gmail.com",
            "event": {
                "id": 17,
                "title": "Refinery Operator",
                "date": "1995-02-06",
                "city": "Lake Malcolm",
                "created_at": "2020-07-06T19:39:52.000000Z",
                "updated_at": "2020-07-06T19:39:52.000000Z"
            },
            "created_at": null,
            "updated_at": null
        }
    ]
}
```

### HTTP Request
`GET api/participants[/event/{id}]`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id параметр фильтрации выборки.

<!-- END_31bf5425994bd5ced1a5fc12e8bc91df -->

#Participant view


<!-- START_910b3ebfc5429cf0c6855fbe01ac268f -->
## Данные участника

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/participants/dolor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/participants/dolor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "id": null,
        "name": "Adela Kshlerin Sr.",
        "email": "keeling.hailee@beer.net",
        "event": {
            "id": 12,
            "title": "Tool Sharpener",
            "date": "2015-09-28",
            "city": "Ruthiestad",
            "created_at": "2020-07-06T19:39:51.000000Z",
            "updated_at": "2020-07-06T19:39:51.000000Z"
        },
        "created_at": null,
        "updated_at": null
    }
}
```

### HTTP Request
`GET api/participants/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  optional  | id участника обязательный параметр .

<!-- END_910b3ebfc5429cf0c6855fbe01ac268f -->

#Update participant


<!-- START_9f9154c9bd24ed706e1c947fec4cbd07 -->
## Обновление данных участника

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/participants/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"action":"similique","data":{"name":"atque","email":"consequatur","even_id":7}}'

```

```javascript
const url = new URL(
    "http://localhost/api/participants/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "action": "similique",
    "data": {
        "name": "atque",
        "email": "consequatur",
        "even_id": 7
    }
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/participants/{id}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `action` | string |  required  | Обязательный параметр `update`
        `data.name` | string |  optional  | Имя участника
        `data.email` | string |  optional  | Email участника
        `data.even_id` | integer |  optional  | id мероприятия
    
<!-- END_9f9154c9bd24ed706e1c947fec4cbd07 -->


