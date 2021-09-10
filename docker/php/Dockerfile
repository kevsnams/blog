FROM php:8.0.10-fpm-alpine3.13
WORKDIR /var/www/html

RUN apk update && apk add \
    build-base

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions gd xdebug swoole mcrypt

RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    
USER www

COPY --chown=www:www . /var/www/html/

EXPOSE 9000
