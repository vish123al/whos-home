FROM php:5.6-apache
# copying php webapp to the server
COPY webapp/www /var/www/html/
COPY webapp/www/index.php /var/www/html/index.php
# need to install the mysql php module
RUN docker-php-ext-install mysql
