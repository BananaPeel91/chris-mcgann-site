#!/bin/bash
set -e

# Check if using PostgreSQL (Railway) or SQLite (local)
if [ -z "$DATABASE_URL" ]; then
    echo "Using SQLite database (local development)"
    # Create SQLite database file if it doesn't exist
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
        chown www-data:www-data /var/www/html/database/database.sqlite
    fi
else
    echo "Using PostgreSQL database (Railway)"
fi

# Run database migrations
php /var/www/html/artisan migrate --force

# Start Apache
exec apache2-foreground

