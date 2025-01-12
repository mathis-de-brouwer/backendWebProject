<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



# BackendWeb Project: News & FAQ Portal

## About
This is a Laravel-based web application that provides a news portal with user management, FAQ system, and contact functionality. The project is built using Laravel 11 and includes features like user authentication, admin controls, news management, and a categorized FAQ system.

## Setup Instructions

1. Clone the repository:

    git clone <your-repository-url>
    cd <project-directory>

2. Install PHP dependencies:

    composer install

3. Install NPM dependecies:

    npm install

4. .env Setup

    cp .env.example .env
    php artisan key:generate

5. Configure your database in .env:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

6. Run migrations and seed database:

    php artisan migrate:fresh --seed

7. Link storage:

    php artisan storage:link

8. Start the development servers:

    npm run dev
    php artisan serve



## Features
#   #User Authentication
    Login/Register
    Password Reset
    Remember Me
#   # User Management
    Public Profile Pages
    Profile Editing
    Admin User Management
#   # News System
    News Article Creation/Management
    Image Upload Support
#   # FAQ System
    Categorized Q&A
    Admin Management Interface
#   # Contact System
    Contact Form
    Admin Email Notifications

## Technologies Used
    Laravel 11
    Tailwind CSS
    Alpine.js
    MySQL/SQLite
    Laravel Breeze

## References & Credits
[Laravel Documentation](https://laravel.com/docs)
[Tailwind CSS](https://tailwindcss.com/)
[Alpine.js](https://alpinejs.dev/)
[Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).