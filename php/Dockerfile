FROM php:7.4.18-fpm-alpine

RUN docker-php-ext-install mysqli

EXPOSE 9000

WORKDIR /var/www

CMD ["php-fpm"]
