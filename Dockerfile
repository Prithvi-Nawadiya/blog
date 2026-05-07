FROM php:8.4-cli

RUN apt-get update && apt-get install -y git curl unzip zip libzip-dev sqlite3 libsqlite3-dev libpq-dev

RUN docker-php-ext-install zip pdo pdo_sqlite pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 10000

CMD ["/usr/local/bin/entrypoint.sh"]