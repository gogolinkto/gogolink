FROM composer as install-dependencies
WORKDIR /app
COPY . .
RUN composer install --ignore-platform-reqs -a --no-interaction --no-dev

FROM php:8.1-apache as application

RUN docker-php-ext-install -j "$(nproc)" opcache mysqli pdo pdo_mysql
RUN a2enmod rewrite

COPY .docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY .docker/cloud-run.ini /usr/local/etc/php/conf.d/cloud-run.ini
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY --from=install-dependencies --chown=www-data:www-data /app/ /var/www/html/

RUN php artisan optimize && php artisan config:clear

