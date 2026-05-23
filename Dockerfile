# Multi-stage Dockerfile for deploying Laravel on Render

# Stage 1: build frontend assets with Node
FROM node:18 AS node
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Stage 2: PHP runtime
FROM php:8.4-fpm

# Install system dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y git unzip zip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring pcntl bcmath xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (copy from official image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app source (respect ownership for www-data)
COPY --chown=www-data:www-data . .

# Copy built frontend assets from node stage
COPY --from=node /app/public/build public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist || true

# Ensure storage and cache are writable
RUN chown -R www-data:www-data storage bootstrap/cache public/build || true

ENV PORT 10000
EXPOSE 10000

# Use PHP built-in server for a simple Render web service (replace with nginx for production)
CMD ["sh","-c","php -S 0.0.0.0:${PORT:-10000} -t public"]
