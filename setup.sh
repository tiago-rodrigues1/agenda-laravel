#!/usr/bin/env bash

composer install

cp ./.env.example ./.env

php artisan key:generate

echo "Nome do APP: "
read app_name

sed -i "1s/^APP_NAME=.*/APP_NAME=$app_name/" ./.env

echo "Configurar DB ? [Y/N]: "
read config_db_resp

if [ $config_db_resp == "y" -o  $config_db_resp == "Y" ]; then
    echo "Nome do DB: "
    read db_name

    sed -i "14s/^DB_USERNAME=.*/DB_USERNAME=$db_name/" ./.env

    echo "Senha do DB: "
    read db_password

    sed -i "16s/^DB_PASSWORD=.*/DB_PASSWORD=$db_password/" ./.env

    echo "Rodar migrate ? [Y/N]: "
    read migrate_resp

    if [ $migrate_resp == "y" -o  $migrate_resp == "Y" ]; then
        php artisan migrate
    fi
fi