# Исходный образ, он будет использован как основа
FROM php:7.4-fpm

# Добавляем образ установщика расширений PHP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Устанавливаем нужные пакеты
RUN apt-get update && apt-get install -y \
        apt-utils \
        curl \
        wget \
        git \
        zip \
        unzip

# Добавим расширения для PHP
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions \
        mcrypt \
        http \
        mysqli \
        pdo_mysql \
        gd \
        xdebug \
        zip


# phpunit
RUN wget https://phar.phpunit.de/phpunit-6.5.phar && \
        chmod +x phpunit-6.5.phar && \
        mv phpunit-6.5.phar /usr/local/bin/phpunit

# codecept
RUN wget http://codeception.com/codecept.phar && \
        chmod +x codecept.phar && \
        mv codecept.phar /usr/local/bin/codecept

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.0.8

# Добавить свой php.ini
#ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

# Указываем рабочую директорию для PHP
WORKDIR /var/www/html

# Запускаем контейнер
CMD ["php-fpm"]