#!/bin/bash
docker rm portfolio
docker run -i -t --entrypoint /bin/bash --name portfolio -e COMPOSER_AUTH="$COMPOSER_AUTH" afisher-symfony:1.0
