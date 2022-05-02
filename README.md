## About TinyEarl (Laravel)

This is my quickest solution on how to emulate Tiny Url's service.

## How to Install

- Clone this repository
- Copy .env.example and name it as .env
- Update the App and Database settings, (use the DB credentials in docker-compose.yml)
- Run `composer install`
- Run `docker-compose build`
- Run `docker-compose up -d`
- Run `docker-compose exec php php artisan key:generate`
- Run `docker-compose exec php php artisan migrate`
- You're all set! Open `http://localhost:8080` in your browser
