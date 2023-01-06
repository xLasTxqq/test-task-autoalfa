### Запуск
<b><i>

## Dev

```bash
docker compose up --build -d --wait && docker exec -it test-task-autoalfa-api-php-1 bash -c "composer u -n && composer i -n && php artisan key:generate && php artisan storage:link && php artisan migrate && php artisan db:seed && php artisan queue:work redis"
```

## Prod

```bash
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d --wait && docker exec -it test-task-autoalfa-api-php-1 bash -c "composer u -n --no-dev && composer i -n --no-dev && php artisan key:generate && php artisan storage:link && php artisan migrate && php artisan db:seed && php artisan queue:work redis"
```

В .env данные почты указать для отправки писем