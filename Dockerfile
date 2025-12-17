FROM php:8.2-apache

# (Común en apps PHP) habilitar rewrite
RUN a2enmod rewrite

# Extensiones típicas para apps con MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html

# Copia el proyecto (como tu index.php está en raíz, funciona perfecto)
COPY . /var/www/html

# Permisos para carpetas que normalmente requieren escritura
# (si no existen, no fallará)
RUN set -eux; \
    mkdir -p /var/www/html/uploads /var/www/html/tmp; \
    chown -R www-data:www-data /var/www/html/uploads /var/www/html/tmp; \
    chmod -R 775 /var/www/html/uploads /var/www/html/tmp

EXPOSE 80
