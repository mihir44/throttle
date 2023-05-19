FROM php:8.2.3-fpm-alpine3.17

ENV TZ="Asia/Kolkata"
RUN apk update
RUN apk add bash curl
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install COMPOSER
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php
RUN composer global require "laravel/installer"

# Install Dependencies
RUN apk update
RUN apk add pkgconfig libgomp
RUN apk add --no-cache ${PHPIZE_DEPS} imagemagick imagemagick-dev

RUN apk update \
    && apk add --no-cache postgresql-client postgresql-dev \
    && docker-php-ext-install pdo_pgsql

RUN pecl install -o -f imagick\
    &&  docker-php-ext-enable imagick

RUN apk del --no-cache ${PHPIZE_DEPS}
RUN apk add --upgrade ghostscript-dev
RUN apk add openjdk8

WORKDIR /var/www/html
COPY . /var/www/html

RUN composer install

RUN chmod +x /var/www/html/run-server.sh
ENTRYPOINT ["/var/www/html/run-server.sh"]

EXPOSE 80