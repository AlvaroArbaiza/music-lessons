# Dockerfile per Laravel 10
FROM php:8.2-cli

# Installa dipendenze di sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    netcat-traditional

# Pulisce la cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installa estensioni PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta la directory di lavoro
WORKDIR /var/www

# Copia i file del progetto
COPY . /var/www

# Installa dipendenze PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Installa dipendenze Node e compila assets
RUN npm install && npm run build

# Copia lo script di avvio
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Imposta permessi per storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Espone la porta 8000 (Laravel artisan serve)
EXPOSE 8000

ENTRYPOINT ["docker-entrypoint.sh"]
