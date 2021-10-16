FROM php:8.0.3-cli-alpine3.13

RUN apk add --no-cache postgresql-dev && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer
