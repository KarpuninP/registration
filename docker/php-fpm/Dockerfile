FROM php:7.4-fpm-alpine



RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d
COPY www.conf /usr/local/etc/php-fpm.d/


USER 1000:1000

WORKDIR /var/www/app




