# Use the official PHP 8.1 FPM image based on Alpine Linux
FROM php:8.1-fpm-alpine

# Copy File Config
ADD ./docker/php/8.1/www.conf /usr/local/etc/php-fpm.d/www.conf

# ADD and set Group
RUN addgroup -g 1000 admin && adduser -G admin -g admin -s /bin/sh -D admin

# Create folder to run
RUN mkdir -p /var/www/html

# Set Profile
RUN chown admin:admin /var/www/html

# Work in the specific space
WORKDIR /var/www/html

# Install system dependencies
RUN apk --update --no-cache add \
    autoconf \
    git \
    libzip-dev \
    libintl \
    postgresql-dev \
    icu-dev \
    build-base \
    unzip \
    gcc \
    g++ \
    make

# Install PHP extensions
RUN docker-php-ext-install zip pdo pdo_pgsql intl opcache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.3.0

# Install PHPUnit globally
RUN composer global require phpunit/phpunit

# Make Composer binaries available system-wide
RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc

# Expose the PHPUnit binary
RUN ln -s /root/.composer/vendor/bin/phpunit /usr/local/bin/phpunit

#RUN composer global require phpunit/phpunit --dev && \
#    ln -s /root/.composer/vendor/bin/phpunit /usr/local/bin/phpunit


RUN apk add --update linux-headers

# Download and compile Xdebug from source
RUN pecl bundle xdebug \
    && cd xdebug \
    && phpize \
    && ./configure \
    && make \
    && make install

# Enable Xdebug extension
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini


# Start PHP-FPM
CMD ["php-fpm"]
