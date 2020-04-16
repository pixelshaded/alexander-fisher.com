#!/bin/bash
docker stop portfolio
docker rm portfolio
docker run -d --name portfolio -p 8888:80 --mount type=bind,source=$(pwd),target=/portfolio-site pixelshaded/symfony-site:1.1
