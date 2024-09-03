#!/bin/sh

# Create the SQLite database file if it doesn't exist
if [ ! -f /var/www/html/database/database.sqlite ]; then
  touch /var/www/html/database/database.sqlite
  chmod 755 /var/www/html/database/database.sqlite
  chown www-data:www-data /var/www/html/database/database.sqlite
fi

# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate app key
php artisan key:generate

# Run Laravel migrations
php artisan migrate --force

# Create symbolic link to access images
php artisan storage:link

# Start the PHP-FPM server
exec php-fpm
