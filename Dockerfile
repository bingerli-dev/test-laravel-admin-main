
FROM php:7.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    nginx \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    opcache

# Enable OPcache for better performance
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.enable_cli=1'; \
    echo 'opcache.memory_consumption=256'; \
    echo 'opcache.interned_strings_buffer=16'; \
    echo 'opcache.max_accelerated_files=20000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    } > /usr/local/etc/php/conf.d/opcache.ini



# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i 's/memory_limit = 128M/memory_limit = 256M/g' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/max_execution_time = 30/max_execution_time = 60/g' "$PHP_INI_DIR/php.ini"

# Set working directory
WORKDIR /var/www

# Configure Nginx
COPY docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
RUN rm /etc/nginx/sites-enabled/default

RUN mkdir -p /etc/supervisor/conf.d/

# Create supervisor config
COPY docker/supervisor/conf.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

# Copy composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

# Copy application files
COPY . .

# Install dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

RUN chmod +x run.sh

# Generate optimized autoload files
RUN composer dump-autoload --optimize
# Expose port 80
EXPOSE 80

# Start supervisor
CMD ["./run.sh"]

