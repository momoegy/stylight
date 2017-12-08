FROM  alpine:latest

RUN apk update
RUN	apk add bash caddy
RUN	apk add php7 php7-fpm

ADD . /app

COPY  res/php.ini  /etc/php7/conf.d/50-setting.ini
COPY  res/php-fpm.conf 	/etc/php7/php-fpm.d/www.conf
RUN   chown 1000:1000 /var/log/php7/

WORKDIR	 /app
USER     1000

CMD caddy
