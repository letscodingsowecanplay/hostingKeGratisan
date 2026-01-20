# Gunakan base image dengan Apache (atau Nginx)
FROM php:8.2-apache

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Install NPM dependencies dan build assets
RUN npm ci --only=production && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy konfigurasi Apache jika perlu
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Port yang digunakan
EXPOSE 8080

# Entrypoint yang lebih fleksibel
COPY docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
