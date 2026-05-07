#!/usr/bin/env bash
set -euo pipefail

# Helpful deployment script for Render or other platforms.
# Run from project root.

echo "Installing PHP dependencies..."
composer install --no-dev --prefer-dist --optimize-autoloader

if [ -f package.json ]; then
  echo "Installing Node dependencies and building assets..."
  npm ci
  npm run build
fi

echo "Running migrations..."
php artisan migrate --force

echo "Creating storage symlink..."
php artisan storage:link || true

echo "Caching config, routes and views..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Deployment helper: done. Start the server with your platform's recommended method."
