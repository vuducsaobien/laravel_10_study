FROM php:8.2-fpm
RUN pecl install redis-5.3.7 \
	&& pecl install xdebug-3.2.1 \
	&& docker-php-ext-enable redis xdebug

RUN apt-get update \
# Install APT packages
    && apt-get install -y  \
# Install ZIP library
    libzip-dev \
# Install ZIP binary
    zip \
# Install Git binary
    git \
# Install PostgresSQL library
    libpq-dev \
# Install Process monitoring package
    procps \
    && docker-php-ext-install pdo_mysql \
# Remove APT lists
    && rm -rf /var/lib/apt/lists/*
# Intall mariadb client 
RUN apt-get update \
    && apt-get install -y mariadb-client

# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/globitsco-2

# Copy the project files
COPY . /var/www/globitsco-2

# Set ownership for writable directories
RUN chown -R www-data:www-data /var/www/globitsco-2/storage /var/www/globitsco-2/bootstrap/cache

# Set default command to run PHP-FPM
# CMD ["php-fpm"]

# Expose port
EXPOSE 9000
