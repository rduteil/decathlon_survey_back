FROM php:7.1

LABEL maintainer="Romain Duteil romain.duteil@insa-lyon.fr"

RUN apt-get update && apt-get install -y cron libpq-dev zlib1g-dev && docker-php-ext-install pdo pdo_pgsql zip

WORKDIR /var/www/html

COPY crontab /etc/cron.d/crontab
COPY timezone.ini /usr/local/etc/php/conf.d/timezone.ini

RUN chmod 0644 /etc/cron.d/crontab
RUN crontab /etc/cron.d/crontab
RUN mkdir saved_files

COPY app ./app
COPY bin ./bin
COPY config ./config
COPY src ./src
COPY vendor ./vendor
COPY web ./web
COPY composer.json .

RUN cron

CMD php bin/console server:run 0.0.0.0:8000

EXPOSE 8000
