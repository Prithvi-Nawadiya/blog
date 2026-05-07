#!/bin/bash

# Exit on error
set -e

echo "Starting deployment script..."

# Ensure storage directories exist on the persistent disk
# Since /app/storage is a mount point, it might be empty on first run
mkdir -p /app/storage/app/public
mkdir -p /app/storage/framework/cache/data
mkdir -p /app/storage/framework/sessions
mkdir -p /app/storage/framework/views
mkdir -p /app/storage/logs

# Fix permissions for storage and bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache
chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Re-create the storage symlink if it doesn't exist
if [ ! -L /app/public/storage ]; then
    echo "Creating storage symlink..."
    php artisan storage:link
fi

# Run migrations (safe, does not delete data)
echo "Running migrations..."
php artisan migrate --force

# Seed the database only if necessary (using updateOrCreate in seeder is safe)
# The user asked to avoid automatic resets, but they want the admin account to stay.
# DatabaseSeeder.php uses updateOrCreate, so it's safe to run.
echo "Ensuring admin account exists..."
php artisan db:seed --force

# Start the application
echo "Starting Laravel server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
