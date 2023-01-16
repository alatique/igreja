FROM php:7.4-apache-buster
MAINTAINER Potato Powered Software <support@potatopowered.net>

# install the PHP extensions we need 
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql

# install composer globally so that you can call composer directly 
RUN curl -sSL https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# enable apache rewrite 
RUN a2enmod rewrite