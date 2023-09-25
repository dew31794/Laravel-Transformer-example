# Laravel-Transformer-example
Simple transformer example, for API use

## Requirement version

<pre>
PHP 7.3+
MariaDB 10.4
Laravel 8+
</pre>

## Installation

1. Clone this repository
2. `composer install`
3. `cp .env.example .env`  Modify database settings `DB_DATABASE`、`DB_USERNAME`、`DB_PASSWORD`
4. `php artisan key:generate`
5. `php artisan migrate --seed`  Creation of databases and seed data.
6. Execute the project `php artisan serve`.

## Usage API

### StaffInfo
##### 【GET】 Show list. 
```
http://localhost/api/v1/staff/list
```
#### 【POST】 Create 
```
http://localhost/api/v1/staff/create
```
Data example(Json)
```json
{
    "num": "S23051",
    "name": "郭XX",
    "gender": "1",
    "phone": "0912321654",
    "email": "admin@example.com",
    "arrival_date": "2023-01-01",
    "resignation_date": null,
    "department": "管理部",
    "job_title": "執行長",
    "status": "1",
    "remark": null
}
```

#### 【GET】 Show Single 
```
http://localhost/api/v1/staff/show/{id}
```
#### 【PUT】 Update 
```
http://localhost/api/v1/staff/update/{id}
```

Data example(Json)
```json
{
    //"num": "S23051",
    "name": "郭測試",
    "gender": "2",
    "phone": "099999999",
    "email": "admin@example.com",
    "arrival_date": "2023-01-01",
    "resignation_date": null,
    "department": "管理部",
    "job_title": "執行長",
    "status": "1",
    "remark": null
}
```
#### 【DELETE】 delete
```
http://localhost/api/v1/staff/delete/{id}
```


---

### Project
#### 【GET】 Show list. 
```
http://localhost/api/v1/project/list
```
#### 【POST】 Create 
```
http://localhost/api/v1/project/create
```

Data example(Json)
```json
{
    "num": "P2300099",
    "name": "文章管理系統",
    "description": null,
    "staff_id": "2",
    "sort": 1,
    "start_date": null,
    "end_date": null,
    "status": 0,
    "remark": null
}
```
#### 【GET】 Show Single 
```
http://localhost/api/v1/project/show/{id}
```
#### 【PUT】 Update 
```
http://localhost/api/v1/project/update/{id}
```
Data example(Json)
```json
{
    // "num": "P2300099",
    "name": "文章管理系統(進階)",
    "description": "測試描述",
    "staff_id": "2",
    "sort": 3,
    "start_date": "2023-09-23",
    "end_date": null,
    "status": 1,
    "remark": null
}
```

#### 【DELETE】 delete
```
http://localhost/api/v1/project/delete/{id}
```


---

### Account
#### 【GET】 Show list. 
```
http://localhost/api/v1/account/list
```
#### 【POST】 Create 
```
http://localhost/api/v1/account/create
```

Data example(Json)
```json
{
    "account": "admin999",
    "password": "Ab123456789",
    "password_confirmation": "Ab123456789",
    "staff_id": 10,
    "status": 0,
    "remark": null
}
```
#### 【GET】 Show Single 
```
http://localhost/api/v1/account/show/{id}
```
#### 【PUT】 Update 
```
http://localhost/api/v1/account/update/{id}
```
Data example(Json)
```json
{
    "status": 0,
    "remark": "TEST"
}
```
#### 【DELETE】 delete
```
http://localhost/api/v1/account/delete/{id}
```

#### 【POST】 Reset Password
```
http://localhost/api/v1/account/reset-password
```

```json
{
    "account": "kfx7T2",
    "old_password": "Aa123456",
    "password": "Aa123456789",
    "password_confirmation": "Aa123456789",
    "token": "wAoY73Fh5CXQeogUTV4foLfA1cVc2AHrU7Ea41b43GznkAuy15fZIw2JQvdkkg4U"
}
```