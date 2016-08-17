#!/bin/bash

sudo docker stop snifferdb
sudo docker rm snifferdb
sudo docker build -t jmarley/mysql:dev -f support/docker/mysql/dev/Dockerfile .
