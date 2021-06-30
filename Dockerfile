FROM php:7.4.18-fpm-alpine
RUN docker-php-ext-install mysqli
RUN echo "clear_env = no" >> /usr/local/etc/php-fpm.d/www.conf
RUN mkdir /app
COPY index.php readdb.php selectyear.php filldb.php dropdown.php test.php /app/
