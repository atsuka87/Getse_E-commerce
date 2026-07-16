release: chmod -R 777 storage bootstrap/cache 2>/dev/null || true && php artisan migrate --force && npm run build && php artisan view:clear
web: php artisan storage:link --force && php artisan serve --host=0.0.0.0 --port=3302
