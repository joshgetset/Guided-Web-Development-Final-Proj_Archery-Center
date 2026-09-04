# ==========================================
# Stage 1: Build frontend assets
# ==========================================
FROM node:22 AS frontend

WORKDIR /app

# Copy package files first
COPY package*.json ./

# Install frontend dependencies
RUN npm install

# Copy frontend source files
COPY resources ./resources
COPY vite.config.js ./
COPY public ./public

# Build Vite assets
RUN npm run build


# ==========================================
# Stage 2: Laravel + Apache
# ==========================================
FROM php:8.4-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install \
        pdo_sqlite \
        mbstring \
        zip \
        gd \
        xml \
        bcmath \
        intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel application
COPY . .

# Copy compiled Vite assets from frontend stage
COPY --from=frontend /app/public/build ./public/build

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin \
    --filename=composer

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

# Configure Apache for Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Create SQLite database
RUN mkdir -p database \
    && touch database/database.sqlite

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache database

EXPOSE 80

# Start Laravel
CMD php artisan package:discover --ansi \
    && php artisan migrate --force \
    && php artisan config:cache \
    && php artisan route:cache \
    && apache2-foreground