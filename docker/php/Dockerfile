FROM php:7.2-fpm
WORKDIR /app

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && \
    apt-get install curl -y && \
    curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
COPY startup.sh /usr/local/bin/startup.sh
RUN chmod 447 /usr/local/bin/startup.sh
CMD /usr/local/bin/startup.sh
