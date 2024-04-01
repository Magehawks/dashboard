FROM php:8.1-fpm

# Install system dependencies
RUN apt update && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


WORKDIR /var/www/dashboard

# Copy the Symfony application
COPY . /var/www/dashboard

# Install Composer and project dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/dashboard

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]