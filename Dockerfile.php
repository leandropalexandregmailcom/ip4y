FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    default-mysql-client \
    iputils-ping \
    nodejs \
    npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy the application files
COPY . .

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install

# Install Node.js dependencies
RUN npm install

# Compile Tailwind CSS
RUN npx tailwindcss -i ./resources/css/app.css -o ./public/css/tailwind.css
RUN npx tailwindcss -i ./resources/css/app.css -o ./public/css/tailwind.css --watch



# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
