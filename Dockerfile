FROM php:8.4-cli

RUN apt-get update && apt-get install -y libzip-dev libpq-dev
RUN docker-php-ext-install zip pdo pdo_pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node:22 /usr/local/bin /usr/local/bin
COPY --from=node:22 /usr/local/lib/node_modules /usr/local/lib/node_modules

WORKDIR /app

COPY . .
RUN composer install
RUN npm ci
RUN npm run build

CMD ["bash", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"]
