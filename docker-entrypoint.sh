#!/bin/bash
set -e

# Create database file if it doesn't exist
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
fi

# Run database migrations
php /var/www/html/artisan migrate --force

# Start Apache
exec apache2-foreground

