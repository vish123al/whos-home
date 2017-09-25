FROM mysql:latest

COPY database/snifferdb-schema-with-data.sql /docker-entrypoint-initdb.d/
RUN apt-get install mysql-server
