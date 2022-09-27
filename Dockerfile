FROM php:7.2-apache
WORKDIR /app-php
COPY . .
CMD [ "php", "./src/Template/Users/login.ctp" ]