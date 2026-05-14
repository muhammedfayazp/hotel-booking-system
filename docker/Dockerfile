FROM php:8.2-fpm-alpine

RUN apk add --no-cache git curl zip unzip bash oniguruma-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring bcmath opcache

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

EXPOSE 9000
CMD ["php-fpm"]
