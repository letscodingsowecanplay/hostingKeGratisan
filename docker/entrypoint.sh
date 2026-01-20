#!/bin/bash

# Generate APP_KEY hanya jika belum ada
if [ -z "$(grep '^APP_KEY=' .env)" ] || [ "$(grep '^APP_KEY=' .env)" = "APP_KEY=" ]; then
    php artisan key:generate --force
    echo "Generated new APP_KEY"
fi

# Run migrations (opsional, bisa juga dilakukan via Railway shell)
# php artisan migrate --force

# Start Apache
exec apache2-foreground
