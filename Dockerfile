FROM php:7.2-apache
WORKDIR .
COPY . .
CMD [ "php", "./src/Template/Users/login.ctp" ]