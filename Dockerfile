# Multi-stage Dockerfile for deploying Laravel on Render

# Stage 1: build frontend assets with Node
FROM node:22 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP runtime
FROM php:8.4-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring pcntl bcmath xml zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app source and build assets
COPY --chown=www-data:www-data . .
COPY --from=frontend /app/public/build public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
RUN chown -R www-data:www-data storage bootstrap/cache public/build

ENV PORT 10000
EXPOSE 10000
CMD ["sh","-c","php -S 0.0.0.0:${PORT:-10000} -t public"]
