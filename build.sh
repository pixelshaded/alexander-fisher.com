#!/bin/bash
docker build --tag afisher-symfony:1.0 --build-arg composer_auth="$COMPOSER_AUTH" .
