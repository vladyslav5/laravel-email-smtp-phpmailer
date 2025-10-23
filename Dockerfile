FROM php:8.2-fpm-alpine


RUN apk update && apk add --no-cache \
    curl \
    bash \
    git \
    shadow \
    libpng-dev \
    libxml2-dev \
    zip \
    vim \
    unzip \
    && rm -rf /var/cache/apk/*

RUN apk add nodejs npm
RUN docker-php-ext-install \
    pdo_mysql \
    exif \
    pcntl



WORKDIR /var/www/

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY docker-compose/php/php.ini /usr/local/etc/php/conf.d/uploads.ini




ENV HOME=/home/www-data

USER www-data:www-data

RUN chmod 777 -R /home/www-data
EXPOSE 9000

CMD ["php-fpm"]
