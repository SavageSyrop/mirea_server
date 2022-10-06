FROM php:8-apache
RUN docker-php-ext-install mysqli
RUN a2enmod authn_dbd
RUN apt-get update
RUN apt-get install -y apache2-utils libaprutil1-dbd-mysql