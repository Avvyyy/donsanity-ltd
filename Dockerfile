# Stage 1: Build Nuxt.js frontend
FROM node:18-alpine AS frontend-builder

WORKDIR /app/frontend

# Copy and install Nuxt.js dependencies
COPY don-sanity-frontend/package*.json ./
RUN npm install

# Copy the frontend source code and build
COPY don-sanity-frontend .
RUN npm run build

# Stage 2: Set up Laravel backend
FROM php:8.2-apache

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel backend
COPY don-sanity-backend .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Stage 3: Serve both frontend and backend
COPY --from=frontend-builder /app/frontend/.output /var/www/html/public/frontend

# Expose ports
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
