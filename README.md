<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://4.bp.blogspot.com/-m2LqYNpNvZ0/UeFlnSNXdmI/AAAAAAAAOWA/C2IEiELD7Ug/s1600/sofra+3.JPG" width="400" alt="Laravel Logo"></a></p>

## Table of Contents
- [About](#about)
- [Features](#features)
- [DataBase](#database)
- [Installation](#installation)
- [Techonolgies](#techonolgies)


## About

Sofra is a mobile application for multi restarurants and there customers   and this is the backend part .
So Customer can make orders , track order status , reviw restaurants , search for restaurnats ....
Restaurant Can manage it's orders , Commissions , Meals to sell ....

This project  consist of : 
- Comprihansive API for Mobile application built using PHP , Laravel , MySql  , Eloquent ORM . 
- Admin Dashboard .

## Features 
- Multi Auth usning (Sanctum)
- Role and Permisssion Managment For admins
- Notification using FCM channels
- Client Managment Services
- Orders Managment Services
- Restaurants  Managment Services
- Meals  Managment Services
- Offers Managment Services
- Reviews and Ratting   Managment Services
- Admin Managment Services
- Commissions Managment Service
- Comprihansive Dashboard
- Repository Desing Pattern


## DataBase 
- Here is the Design : http://www.laravelsd.com/share/rCOhPs

## Installation 

- prerequisites: 
```
-Laravel v11
-PHP v8.2^
```

- clone the project :
 ```
   git clone https://github.com/aboodmagdy1/Sofra.git
   cd Sofra
 ```
- Serve project : 
  - Laravel  Herd : open as site then visit sofra.text
  - or put project of main dir of XAMPP then visit localhost/

- install Dependencies :
``` 
composer install
```

- set  the .env file ( copy from example)
 ```
  copy env.example into .env file 
 ```
Then for Usage  :
- set your DB configration

- Built DB tables
```
php artisan migrate
```



## Techonolgies: 
- [Laravel](https://laravel.com/docs/11.x) v11
- [PHP](https://www.php.net/docs.php) v8.2
- [Spatie](https://spatie.be/docs/laravel-permission/v6/introduction) v6
- [laravel-notification-channels](https://github.com/laravel-notification-channels/fcm)
- MySql
- Eloquent ORM
- Mailtrap for Mails 

