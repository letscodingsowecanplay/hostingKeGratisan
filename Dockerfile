FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev default-mysql-client nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring gd zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

RUN chmod -R 775 storage bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

RUN if [ -f "package.json" ]; then npm ci && npm run build; fi

EXPOSE 8080

CMD ["sh", "-c", "\
    if [ -n \"${MYSQLHOST}\" ]; then \
        for i in {1..10}; do \
            mysql -h \"${MYSQLHOST}\" -u \"${MYSQLUSER}\" -p\"${MYSQLPASSWORD}\" -e 'SELECT 1;' 2>/dev/null && break; \
            sleep 3; \
        done; \
        php artisan migrate --force; \
    fi; \
    php artisan config:clear; \
    php artisan cache:clear; \
    php artisan serve --host=0.0.0.0 --port=8080 \
"]
