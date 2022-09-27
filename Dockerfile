FROM php:7.2-apache
WORKDIR /app-php
COPY . .
RUN npm install
ENTRYPOINT npm start