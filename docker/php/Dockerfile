FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    libxml2-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip xml \
    && docker-php-ext-enable opcache \
    && apt-get clean

RUN apt install -y nodejs npm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install xdebug-3.4.0 \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY docker/php/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

RUN chown -R www-data:www-data /var/www/html

CMD ["/usr/local/bin/start.sh"]
