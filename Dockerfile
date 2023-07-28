FROM php:8.2.8-fpm-alpine as base

WORKDIR /var/www

# Override Docker configuration: listen on Unix socket instead of TCP
RUN sed -i "s|listen = 9000|listen = /var/run/php/fpm.sock\nlisten.mode = 0666|" /usr/local/etc/php-fpm.d/zz-docker.conf

# Install dependencies
RUN set -xe \
    && apk add --no-cache bash icu-dev postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql intl pcntl

COPY docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

CMD ["php-fpm"]
