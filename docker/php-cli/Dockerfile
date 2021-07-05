FROM php:8.0.8-cli

RUN apt-get update \
    && apt-get install -y git wget vim

RUN apt-get install -y libzip-dev libmemcached-dev \
    && pecl install zip \
    && pecl install memcached \
    && pecl install apcu \
    && docker-php-ext-enable zip \
    && docker-php-ext-enable memcached \
    && docker-php-ext-enable apcu \
    && docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

