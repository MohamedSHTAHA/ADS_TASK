<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About ADS TASK

Simple Ads API
Create a simple Ads management API that shows ads and related tags/categories. It will be a part of a module handling the Advertiser
functionalities towards these ads. Since advertiser will be assigned with an ad to start and should include the following

## Ads Attributes

Ads Attributes:
type(free/paid), title, description, category, tags, advertiser, start_date.
-Each Ad is created under one category and has many related tags
-One category can have many ads and each Ad is related to one category.
-schedule a daily email at 08:00 PM that will be sent to advertisers who have ads the next day as a remainder.
Endpoints should contains: -Tags (CRUD)
-Categories (CRUD)
-Ads filters (by tag, by category) -Showing Advertiser Ads

## Notes
-Use any recent version of laravel framework.
-It will not be necessary to do any Authentication, you can just seed the database with some advertiser to be linked with Ads.
-You should implement this project in clean code and always take care of scalability.
-Create a public github repository and push your project to it.

###  Run Project

- cp .env.example .env
- change database config (env)
- change email config (env)
- composer install 
- php artisan migrate
- php artisan serve
- php artisan db:seed
- insert categories-tags-ads
- php artisan ads:remainder


###  Contact Us

- **[WathApp](https://www.wppredirect.tk/go/?p=+201551648339&amp;m=MohammedTaha)**
- **[Github](https://github.com/MohamedSHTAHA/MohamedSHTAHA)**
- **[Linkedin](https://www.linkedin.com/in/mohamed-shaban-taha-8782a0108/)**
