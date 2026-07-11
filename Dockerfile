# Image de production Laravel pour Render (Docker).
FROM php:8.3-apache

# Dépendances système + extensions PHP (MySQL + PostgreSQL).
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Composer.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache : docroot = public/, réécriture d'URL activée.
RUN a2enmod rewrite \
    && printf '<VirtualHost *:80>\n\tDocumentRoot /var/www/html/public\n\t<Directory /var/www/html/public>\n\t\tAllowOverride All\n\t\tRequire all granted\n\t</Directory>\n</VirtualHost>\n' \
        > /etc/apache2/sites-available/000-default.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY . .

# Installation des dépendances PHP (sans dev) + permissions.
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && chmod +x docker/start.sh \
    && chown -R www-data:www-data storage bootstrap/cache

# Render fournit le port via $PORT : appliqué au démarrage (voir docker/start.sh).
CMD ["sh", "docker/start.sh"]
