#!/bin/bash

if [ ! -d $(pwd)/vendor ]; then
    docker-php-ext-install pdo_mysql
    apt-get update &&  \
    apt-get install -y libzip-dev libssl-dev git unzip && \
    curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
fi
if [ "$INSTALL_VENDOR" = "y" ]; then
    sed 's/DB_HOST=127.0.0.1/DB_HOST=database/;s/DB_PASSWORD=/DB_PASSWORD=root/' .env.example > .env && \
    chmod 777 .env && \
    chmod 777 -R storage && \
    composer install && \
    chmod 775 -R /opt/vendor
    if [ "$(cat .env | grep -w 'APP_KEY=' | cut -d = -f 1)" = APP_KEY ]; then
        php artisan key:generate && \
        useradd dennys -d /home/dennys -m
    fi
fi
docker-php-entrypoint php-fpm


#docker exec php1 useradd dennys -d /home/dennys
#docker exec -it php1 /bin/bash
#su dennys





# remove all
# docker container prune -f && docker rmi $(docker images -q) -f && sudo rm -rf vendor/ .env
