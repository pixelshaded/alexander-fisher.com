#!/bin/bash
tag=pixelshaded/symfony-environment:1.0
docker build --tag $tag .
docker push $tag
