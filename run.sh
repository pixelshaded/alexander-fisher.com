#!/bin/bash
docker stop portfolio
docker rm portfolio
docker run -d --name portfolio -p 8888:80 pixelshaded/symfony-site:1.0
