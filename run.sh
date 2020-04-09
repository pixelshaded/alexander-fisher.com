#!/bin/bash
docker rm portfolio
docker run -i -t --entrypoint /bin/bash --name portfolio -e COMPOSER_AUTH="$COMPOSER_AUTH" -p 8888:80 afisher-symfony:1.0
