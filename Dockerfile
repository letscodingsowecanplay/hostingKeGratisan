FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    curl \
    zip unzip \
    default-mysql-client \
    nodejs npm \
    pkg-config \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd zip \
    && curl -sS https://getcomposer.org/installer | php \
        -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

RUN chmod -R 775 storage bootstrap/cache \
    && composer install --no-dev --optimize-autoloader

RUN if [ -f "package.json" ]; then npm ci && npm run build; fi

EXPOSE 8080

CMD ["sh", "-c", "\
    php artisan serve --host=0.0.0.0 --port=8080 \
"]
