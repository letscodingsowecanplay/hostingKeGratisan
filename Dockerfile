FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev default-mysql-client nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring gd zip \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY . .


RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader

RUN if [ -f "package.json" ]; then npm ci && npm run build; fi

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

CMD ["entrypoint.sh"]
