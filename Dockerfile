# Use PHP 5.6 with Apache
FROM php:5.6-apache

# Set working directory inside the container
WORKDIR /var/www

# Switch to Debian Archive Mirrors for EOL versions
RUN sed -i 's|http://deb.debian.org/debian|http://archive.debian.org/debian|g' /etc/apt/sources.list && \
    sed -i '/stretch-updates/d' /etc/apt/sources.list && \
    sed -i '/security/d' /etc/apt/sources.list

# Update package lists and install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    mariadb-client \
    libzip-dev \
    zip \
    && docker-php-ext-install mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer (old version compatible with PHP 5.6)
RUN curl -sS https://getcomposer.org/installer | php -- --version=1.10.26 && \
    mv composer.phar /usr/local/bin/composer

# Copy project files into the container
COPY . .

# Install PHP dependencies with Composer (ignoring errors)
RUN composer install --no-dev --optimize-autoloader || true
RUN echo "date.timezone=America/Mexico_City" > /usr/local/etc/php/conf.d/timezone.ini

COPY apache-custom.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose Apache port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]