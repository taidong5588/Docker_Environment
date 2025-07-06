# Use official PHP image as a base
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install necessary dependencies and PHP extensions
# - libzip-dev, zip: for zip extension
# - mysqli: for MariaDB/MySQL connection
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    zip \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mysqli \
    zip

# Install Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a dedicated user to run PHP-FPM
# This is a good practice for security
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/sh -g www www

# Switch to the new user
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
