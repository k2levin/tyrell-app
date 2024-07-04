FROM alpine:3.16
# Alpine v3.16 will install php v8.1.11

RUN set -x \

    # create non-root user
    && adduser -D -u 1000 -S www-data -G www-data \

    # install required software packages
    && apk add --no-cache alpine-sdk nginx nodejs npm s6 \

    # install php and extensions
    php81 php81-bcmath php81-ctype php81-curl php81-dom php81-fileinfo php81-fpm php81-iconv php81-json php81-mbstring \
    php81-opcache php81-openssl php81-pdo_mysql php81-pcntl php81-pecl-mongodb php81-phar php81-posix php81-redis \
    php81-session php81-tokenizer php81-xml php81-xmlwriter

COPY --chmod=755 ./dockerfiles/entrypoint.sh /
COPY --chmod=755 ./dockerfiles/setup.sh /
COPY --chmod=644 ./dockerfiles/nginx/default.conf /etc/nginx/http.d/
COPY --chmod=644 --chown=www-data:www-data ./dockerfiles/php/opcache.ini /etc/php81/conf.d/00_opcache.ini
COPY --chmod=755 --chown=www-data:www-data ./dockerfiles/s6-scan/. /run/openrc/s6-scan/
COPY --chmod=u=rwX,go=rX --chown=www-data:www-data . /var/www/html/

# set configuration and optimize for production
RUN /setup.sh

# run with non-root user to ensure least privilege
USER www-data
WORKDIR /var/www/html
ENTRYPOINT ["/entrypoint.sh"]
CMD ["sh"]
