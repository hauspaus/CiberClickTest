FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \

RUN docker-php-ext-install gd \
	&& docker-php-ext-install gettext \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/php/entrypoint.sh /entrypoint.sh
COPY ./src /var/www/html

RUN chmod +x /entrypoint.sh

ENTRYPOINT /entrypoint.sh
