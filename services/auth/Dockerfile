FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpq-dev libicu-dev libzip-dev \
    && docker-php-ext-install pdo_pgsql intl zip \
    && rm -rf /var/lib/apt/lists/*

# Install Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html/vendor /var/www/html/var

CMD ["php-fpm"]
