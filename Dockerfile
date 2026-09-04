FROM php:8.3-apache

# Install system deps + PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev libicu-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip gd xml curl ctype fileinfo tokenizer bcmath intl

# Enable Apache mod_rewrite (needed for Laravel's pretty URLs)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies (production, no dev packages, skip scripts for now —
# scripts need a full app boot which isn't safe until the container actually runs)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Point Apache's document root to Laravel's /public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Create SQLite database file + fix permissions
RUN mkdir -p database && touch database/database.sqlite
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache database

EXPOSE 80

# Discover packages, run migrations, cache config/routes, then start Apache
CMD php artisan package:discover --ansi && php artisan migrate --force && php artisan config:cache && php artisan route:cache && apache2-foreground