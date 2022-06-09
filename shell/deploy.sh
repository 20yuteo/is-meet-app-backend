docker compose exec app composer install
docker compose exec app cp .env.prod .env
docker compose exec app php artisan key:generate
docker compose exec app php artisan storage:link
docker compose exec app chmod -R 777 storage bootstrap/cache