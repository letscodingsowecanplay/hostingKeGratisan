FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev gnupg libfreetype6-dev libjpeg62-turbo-dev libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring exif pcntl bcmath zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

RUN if [ -f ".env.example" ] && [ ! -f ".env" ]; then \
    cp .env.example .env; \
    fi

RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts \
    && composer dump-autoload --optimize

RUN if [ -f "package.json" ]; then \
    npm ci --no-audit --prefer-offline && \
    npm run build; \
    fi

RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear

HEALTHCHECK --interval=30s --timeout=3s --start-period=10s --retries=3 \
    CMD curl -f http://localhost:8080/health || exit 1

EXPOSE 8080

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8080"]
