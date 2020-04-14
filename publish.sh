#!/bin/bash
tag=pixelshaded/symfony-site:1.0
docker build --tag $tag .
docker push $tag
