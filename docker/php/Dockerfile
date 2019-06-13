FROM php:7.2-fpm
WORKDIR /app

RUN apt-get update && \
    apt-get install -y curl libzip-dev zip && \
    curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install mysqli pdo pdo_mysql zip

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash && \
    apt-get install -y nodejs && \
    npm install -g yarn




ENV COMPOSER_ALLOW_SUPERUSER 1
COPY startup.sh /usr/local/bin/startup.sh
RUN chmod 447 /usr/local/bin/startup.sh
CMD /usr/local/bin/startup.sh
