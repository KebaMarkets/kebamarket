FROM php:8.4-fpm

# Install system deps
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpq-dev libicu-dev libzip-dev \
    && docker-php-ext-install pdo_pgsql intl zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first
COPY composer.json composer.lock* ./

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install --no-scripts --no-interaction --prefer-dist

# Copy project source
COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/vendor /var/www/html/var

CMD ["php-fpm"]
