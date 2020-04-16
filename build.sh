#!/bin/bash
docker build --tag pixelshaded/symfony-site:1.1 --build-arg composer_auth="$COMPOSER_AUTH" .
