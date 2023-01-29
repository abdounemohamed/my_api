#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
(/usr/bin/php8.0 artisan down) || true

# Pull the latest version of the app
git pull origin main

# Install composer dependencies
/usr/bin/php8.0 composer.phar install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
/usr/bin/php8.0 artisan clear-compiled

# Recreate cache
/usr/bin/php8.0 artisan optimize

# Run database migrations
/usr/bin/php8.0 artisan migrate --force

# Exit maintenance mode
/usr/bin/php8.0 artisan up

echo "Deployment finished!"
