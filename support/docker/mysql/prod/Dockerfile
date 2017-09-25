FROM mysql:latest

COPY database/snifferdb-schema.sql /docker-entrypoint-initdb.d/
RUN apt-get install mysql-server
RUN service mysql start
