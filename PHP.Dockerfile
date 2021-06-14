FROM php:7.1-apache
COPY apache2.conf /etc/apache2
RUN docker-php-ext-install mysqli pdo pdo_mysql