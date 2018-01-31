FROM library/nginx:1.13

COPY ./src /var/www/html
COPY ./docker/nginx/conf.d /etc/nginx/conf.d

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
