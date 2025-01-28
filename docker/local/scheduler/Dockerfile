#   COMPOSER
FROM composer:latest AS composer

#   PHP BUILDERail up
FROM php:8.4.2-fpm AS php

# Install system dependencies.
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Install PHP extensions.
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN pear update-channels
RUN pecl update-channels

RUN pecl install -o -f redis \
    && docker-php-ext-enable redis \
    && rm -rf /tmp/pear

# Clear cache.
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory.
WORKDIR /var/www
COPY . /var/www
COPY .env /var/www/.env

RUN composer install
RUN composer dump-autoload -o \
    && chown -R :www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

CMD ["/bin/sh", "/var/www/docker/local/scheduler/scheduler.sh"]
