#!/bin/bash

if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ ! -d "node_modules" ]; then
    echo "Installing npm dependencies..."
    npm install
fi

echo "Building webpack assets..."
npx webpack --mode production

chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs 2>/dev/null || true

echo "Starting PHP server on port 8080..."
exec php -S 0.0.0.0:8080 -t /var/www/html/webroot /var/www/html/webroot/index.php