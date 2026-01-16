FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    curl \
    npm \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better cache
COPY composer.json composer.lock ./

# Install Laravel dependencies (before copying all files for better cache)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy rest of the application
COPY . .

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Build frontend assets if needed
RUN if [ -f package.json ]; then npm install && npm run build || true; fi

# Expose port (Render uses 10000 by default for web services)
EXPOSE 10000

# Generate key if needed, cache config, and start Laravel server for Render
CMD php artisan key:generate --force && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=10000
