FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    curl libpng-dev libonig-dev zip unzip \
    default-mysql-client nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring gd zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN chmod -R 775 storage bootstrap/cache \
    && composer install --no-dev --optimize-autoloader

RUN if [ -f "package.json" ]; then npm ci --only=production && npm run build; fi

EXPOSE 8080

CMD ["sh", "-c", "\
    [ -n \"${MYSQLHOST}\" ] && for i in {1..5}; do \
        mysql -h \"${MYSQLHOST}\" -u \"${MYSQLUSER}\" -p\"${MYSQLPASSWORD}\" -e 'SELECT 1;' 2>/dev/null && break; \
        sleep 2; \
    done; \
    php artisan migrate --force 2>/dev/null || true; \
    php artisan config:clear; \
    php artisan cache:clear; \
    php artisan serve --host=0.0.0.0 --port=8080 \
"]
