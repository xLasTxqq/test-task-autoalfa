### Запуск
<b><i>
```bash
docker compose up --build -d --wait && docker exec -it test-task-autoalfa-php-1 bash -c "composer u -n && composer i -n && php artisan key:generate && php artisan storage:link && php artisan migrate && php artisan db:seed && php artisan queue:work redis"
```
В .env данные почты указать для отправки писем

P.S. С правами и ролями во vue не разобрался, так что ссылки и кнопки будут для всех видны