<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Getting started
## Installation

Please check the official laravel installation guide for server requirements before you start. <a href="https://laravel.com/docs/8.x/installation">Official Documentation</a>

Clone the repository

    git clone https://github.com/karimidbouhouch/test-coding-challenges.git

Switch to the repo folder

    cd test-coding-challenges

Install backend dependencies using composer

    composer install

Copy .env.example file to .env

    cp .env.example .env

Run the database migrations

    php artisan migrate

Run the database seeder

    php artisan db:seed

Install frontend dependencies using npm

    npm install

Build assets

    npm run dev

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


## CLI Features

Category
- Create : 
    `php artisan category:create`
- Delete : 
    `php artisan category:delete`

Product
- Create : 
    `php artisan product:create`
- Delete : 
    `php artisan product:delete`