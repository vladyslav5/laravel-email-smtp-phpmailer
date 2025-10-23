# Laravel Email SMTP (PHPMailer)

## Deployment

```bash
git clone https://github.com/vladyslav5/laravel-email-smtp-phpmailer
cd laravel-email-smtp-phpmailer

cp .env.example .env

docker compose up -d --build

docker exec -it app bash
composer install
php artisan key:generate
npm i
npm run build
php artisan migrate
php artisan config:clear

exit 
REBUILD CONTAINER 
docker-compose down
docker-compose up -d --build
``` 
# Testing 
```bash 
docker compose exec -it app php artisan test
 ```
Check emails 
```http://localhost:8025/```
