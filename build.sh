#!/bin/bash
docker build --tag pixelshaded/symfony-site:1.0 --build-arg composer_auth="$COMPOSER_AUTH" .
