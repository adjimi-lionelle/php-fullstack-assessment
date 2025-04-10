FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    g++ \
    git \
    libicu-dev \
    zip \
    unzip

RUN docker-php-ext-install intl pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www

COPY . /var/www

COPY docker/script.sh /var/www/docker/script.sh

RUN chmod +x /var/www/docker/script.sh

EXPOSE 9000

ENTRYPOINT ["/var/www/docker/script.sh"]