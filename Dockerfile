FROM stackbrew/debian:wheezy

ENV DEBIAN_FRONTEND noninteractive

RUN echo "deb http://http.debian.net/debian wheezy-backports main" >/etc/apt/sources.list.d/backports.list
RUN apt-get update

RUN apt-get install -y nginx php5-fpm php5-mysql php5-mcrypt php5-intl php5-curl php5-cli mysql-server mysql-client curl

RUN sed -i 's|;cgi.fix_pathinfo=0|cgi.fix_pathinfo=0|g' /etc/php5/fpm/pool.d/www.conf
RUN sed -i 's|;date.timezone =|date.timezone = "Europe/Paris"|g' /etc/php5/fpm/php.ini
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ADD docker/default /etc/nginx/sites-enabled/default

ADD . /var/www

WORKDIR /var/www

RUN composer install
RUN chmod +x /var/www/vendor/propel/propel1/generator/bin/phing.php
RUN cp app/config/Propel/runtime-conf.xml.dist app/config/Propel/runtime-conf.xml
RUN /etc/init.d/mysql start && (echo "CREATE DATABASE pac DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; GRANT ALL ON pac.* TO pac@localhost IDENTIFIED BY 'pac++';" | mysql)
RUN sed -i "s@#{database}#@pac@;s@#{username}#@pac@;s@#{password}#@pac++@" app/config/Propel/runtime-conf.xml
RUN ./vendor/bin/propel-gen app/config/Propel main
RUN /etc/init.d/mysql start && (zcat app/resources/Pac.sql.gz | mysql pac)

RUN mkdir -p app/cache app/logs
RUN chgrp -R www-data app/cache app/logs
RUN chmod -R g+w app/cache app/logs

RUN rm web/index_dev.php

EXPOSE 80
CMD /etc/init.d/mysql start && /etc/init.d/php5-fpm start && /etc/init.d/nginx start && /bin/bash

