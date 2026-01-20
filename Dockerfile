# GANTI: Gunakan PHP-CLI dengan built-in server (hindari Apache conflict)
FROM php:8.2-cli

# 1. INSTALL SYSTEM DEPENDENCIES
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev gnupg libfreetype6-dev libjpeg62-turbo-dev libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring exif pcntl bcmath zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. INSTALL NODE.js 20 LTS (untuk vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# 3. INSTALL COMPOSER
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. SET WORKING DIRECTORY
WORKDIR /var/www/html

# 5. COPY APLIKASI (dengan .dockerignore yang tepat)
COPY . .

# 6. SET PERMISSIONS SEBELUM INSTALL
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 7. COPY .env.example JIKA .env TIDAK ADA
RUN if [ -f ".env.example" ] && [ ! -f ".env" ]; then \
    cp .env.example .env; \
    fi

# 8. INSTALL PHP DEPENDENCIES (dengan optimization)
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts \
    && composer dump-autoload --optimize

# 9. INSTALL NODE DEPENDENCIES & BUILD ASSETS
RUN if [ -f "package.json" ]; then \
    npm ci --no-audit --prefer-offline && \
    npm run build; \
    fi

# 10. RUN LARAVEL OPTIMIZATION
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear

# 11. HEALTH CHECK UNTUK RAILWAY
HEALTHCHECK --interval=30s --timeout=3s --start-period=10s --retries=3 \
    CMD curl -f http://localhost:8080/health || exit 1

# 12. EXPOSE PORT UNTUK RAILWAY
EXPOSE 8080

# 13. START COMMAND YANG OPTIMAL
CMD ["sh", "-c", "php artisan config:cache && php artisan serve --host=0.0.0.0 --port=8080"]
