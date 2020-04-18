#!/bin/bash
docker stop dependencies
docker rm dependencies
docker run -d --name dependencies pixelshaded/symfony-dependencies:1.1
