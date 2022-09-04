FROM php:8.1.1-apache

# Arguments
ARG user=well
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete

# Copy configuration apache
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# Set rewrite modules
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Expose port
EXPOSE 80

# Set working directory
WORKDIR /var/www/html/backend

USER $user
