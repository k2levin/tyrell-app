#!/bin/sh

set -e

# Laravel scheduler setup
if [ "$SCHEDULER" != 'Y' ]; then
    rm -Rf /run/openrc/s6-scan/crond
fi

# Laravel queue worker setup
if [ "$QWORKER" != 'Y' ]; then
    rm -Rf /run/openrc/s6-scan/qworker
fi

if [ "$APP_ENV" = 'local' ]; then
    # Laravel setup for local development
    printf '%s\n' "$(sed 's/opcache.enable=1/opcache.enable=0/1' /etc/php81/conf.d/00_opcache.ini)" > /etc/php81/conf.d/00_opcache.ini
else
    # Laravel optimize for production
    COMPOSER_MEMORY_LIMIT=-1 composer install -a --no-dev --ignore-platform-reqs --working-dir=/var/www/html
    php /var/www/html/artisan config:cache
    php /var/www/html/artisan route:cache
    php /var/www/html/artisan view:cache
fi

exec /bin/s6-svscan /run/openrc/s6-scan
