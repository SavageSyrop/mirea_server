FROM php:7.2-apache
RUN apt-get update
RUN apt-get -y install apache2-utils libaprutil1-dbd-mysql
RUN a2enmod authn_dbd
RUN docker-php-ext-install mysqli