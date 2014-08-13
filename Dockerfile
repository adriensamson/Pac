FROM stackbrew/debian:wheezy

ENV DEBIAN_FRONTEND noninteractive

RUN echo "deb http://http.debian.net/debian wheezy-backports main" >/etc/apt/sources.list.d/backports.list
RUN apt-get update

RUN apt-get install -y nginx php5-fpm php5-sqlite php5-mcrypt php5-intl php5-curl php5-cli sqlite3 curl

RUN sed -i 's|;cgi.fix_pathinfo=0|cgi.fix_pathinfo=0|g' /etc/php5/fpm/pool.d/www.conf
RUN sed -i 's|;date.timezone =|date.timezone = "Europe/Paris"|g' /etc/php5/fpm/php.ini
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ADD docker/default /etc/nginx/sites-enabled/default

ADD . /var/www

WORKDIR /var/www

RUN composer install
RUN chmod +x /var/www/vendor/propel/propel1/generator/bin/phing.php
RUN ./vendor/bin/propel-gen app/config/Propel main
RUN ./vendor/bin/propel-gen app/config/Propel main
RUN cat app/config/Propel/sql/Pac.Model.schema.sql | sqlite3 app/db.sqlite
RUN cp app/config/Propel/runtime-conf.xml.dist app/config/Propel/runtime-conf.xml
RUN sed -i "s@<dsn>.*@<dsn>sqlite:/var/www/app/db.sqlite</dsn>@;/<user>/d;/<password>/d" app/config/Propel/runtime-conf.xml

RUN ./console parse 2010
RUN ./console parse 2011
RUN ./console parse 2012

RUN mkdir -p app/cache app/logs
RUN chgrp -R www-data app/cache app/logs
RUN chmod -R g+w app/cache app/logs

RUN rm web/index_dev.php

EXPOSE 80
CMD /etc/init.d/php5-fpm start && /etc/init.d/nginx start && /bin/bash

