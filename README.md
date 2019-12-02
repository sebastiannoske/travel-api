# travel-api

This project is developed using Laravel 5.6 ( https://laravel.com/docs/5.6 ). It contains a custom content management system to create content for books. It also offers an API, which delivers content.

## Installation
- git clone https://github.com/sebastiannoske/travel-api.git projectname
- cd projectname
- composer install ( if not installed, get it: https://getcomposer.org/ )
- php artisan key:generate
- Create a database and inform .env
- php artisan migrate --seed to create and populate tables
- Inform config/mail.php for email sends
- php artisan serve to start the app on http://localhost:8000/
