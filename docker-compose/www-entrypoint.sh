#!/bin/bash

npm install

touch /var/log/vite.log

nohup npm run dev > /var/log/vite.log 2>&1 &

docker-php-entrypoint php-fpm
