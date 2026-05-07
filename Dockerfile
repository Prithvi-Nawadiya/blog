FROM php:8.4-cli

RUN apt-get update && apt-get install -y git curl unzip zip libzip-dev sqlite3 libsqlite3-dev

RUN docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN cp .env.example .env || true

RUN php artisan config:clear || true

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000