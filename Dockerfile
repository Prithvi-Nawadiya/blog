FROM php:8.4-cli

RUN apt-get update && apt-get install -y git curl unzip zip libzip-dev sqlite3 libsqlite3-dev

RUN docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN mkdir -p /app/database
RUN touch /app/database/database.sqlite

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN php artisan storage:link

EXPOSE 10000

CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT