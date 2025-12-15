FROM composer:2 AS composer
FROM php:8.5-fpm AS php

RUN apt-get update && apt-get install -y \
    git \
    curl \
    supervisor \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN pear update-channels
RUN pecl update-channels

RUN pecl install -o -f redis \
    && docker-php-ext-enable redis \
    && rm -rf /tmp/pear

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www
COPY .env /var/www/.env
COPY ./docker/local/worker/supervisord.conf /etc/supervisor/conf.d/supervisor.conf

RUN composer install
RUN composer dump-autoload -o \
    && chown -R :www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

CMD ["/bin/sh", "/var/www/docker/local/worker/worker.sh"]
