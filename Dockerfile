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

# Copier tout le projet avant d'installer les dépendances
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Créer un .env par défaut si absent (pour Render)
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Créer le fichier SQLite si besoin (pour Render)
RUN mkdir -p database && touch database/database.sqlite

# Exécuter les migrations pour créer les tables dans la base SQLite
RUN php artisan migrate --force || true

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Build frontend assets if needed
RUN if [ -f package.json ]; then npm install && npm run build || true; fi

# Expose port (Render uses 10000 by default for web services)
EXPOSE 10000

# Generate key if needed, cache config, and start Laravel server for Render
CMD php artisan key:generate --force && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=10000
