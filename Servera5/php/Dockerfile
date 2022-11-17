FROM php:7.2-apache
RUN apt-get update
RUN a2enmod authn_dbd
RUN apt install apache2 libaprutil1-dbd-mysql -y
RUN docker-php-ext-install mysqli
RUN pecl install redis && docker-php-ext-enable redis