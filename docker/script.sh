#!/bin/bash
set -e

# Install PHP dependencies
composer install

# Create the database 
php bin/console doctrine:database:create --if-not-exists

# Generate a migration file if none exists
if [ ! -d "migrations" ] || [ -z "$(ls -A migrations)" ]; then
    php bin/console make:migration
fi

# Apply database migrations
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

# Load fixtures
php bin/console doctrine:fixture:load --no-interaction

# Start PHP-FPM to run the Symfony application
php-fpm