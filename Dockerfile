FROM php:8.3-apache

# Install system deps + PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip gd

# Enable Apache mod_rewrite (needed for Laravel's pretty URLs)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies (production, no dev packages)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Point Apache's document root to Laravel's /public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Create SQLite database file + fix permissions
RUN mkdir -p database && touch database/database.sqlite
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache database

EXPOSE 80

# Run migrations, then cache config, then start Apache
CMD php artisan migrate --force && php artisan config:cache && php artisan route:cache && apache2-foreground