FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev default-mysql-client nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring gd zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

RUN composer install --no-dev --optimize-autoloader

RUN if [ -f "package.json" ]; then npm ci && npm run build; fi

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000


