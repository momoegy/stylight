FROM		alpine:latest

RUN			apk update
RUN			apk add bash caddy
RUN			apk add php7

ADD			. /app

COPY 		res/php.ini 		/etc/php7/conf.d/50-setting.ini
COPY 		res/php-fpm.conf 	/etc/php7/php-fpm.d/www.conf

WORKDIR		/app

CMD			caddy
