FROM php:7.0.10-apache

RUN apt-get update \
  && apt-get -y install curl libpng12-dev zlib1g-dev libssl-dev \
  && docker-php-ext-install zip mbstring bcmath \
  && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN a2enmod rewrite

WORKDIR /var/www

RUN apt-get update \
  && apt-get -y install git
COPY ./composer.json ./composer.lock  /var/www/
RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-interaction \
    && rm composer.phar && apt-get -y purge git && apt-get -y autoremove

COPY ./docker/config/apache2.conf /etc/apache2/apache2-ext.conf
COPY ./docker/config/php.ini /usr/local/etc/php/php.ini

RUN cat /etc/apache2/apache2-ext.conf > /etc/apache2/apache2.conf

COPY . /var/www/html/
WORKDIR /var/www/html/

CMD [ "apache2", "-DFOREGROUND" ]
