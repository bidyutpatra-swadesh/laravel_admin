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

#general
<!-- START_93ed2c95934bcc47d722919661fcce6c -->
## api/v1/get-user-data

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/get-user-data" \
    -H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/get-user-data",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
[
    {
        "id": 1,
        "f_name": "John",
        "l_name": "Doe",
        "email": "admin@gmail.com",
        "status": "Active",
        "created_at": null,
        "updated_at": null
    }
]
```

### HTTP Request
`GET api/v1/get-user-data`


<!-- END_93ed2c95934bcc47d722919661fcce6c -->


