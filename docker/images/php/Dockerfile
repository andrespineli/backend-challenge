FROM php:7.2.0RC5-fpm-alpine3.6

RUN apk update
RUN docker-php-ext-install pdo pdo_mysql

RUN apk add php7-mbstring
RUN apk add php7-pdo_mysql
RUN apk add php7-pdo
RUN apk add php7-openssl
RUN apk add php7-tokenizer
RUN apk add php7-xml
RUN apk add php7-xdebug

RUN rm -Rf /var/cache/apk/*
RUN ln -s /usr/bin/php7 /usr/bin/php

RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer

WORKDIR /usr/share/nginx/html


