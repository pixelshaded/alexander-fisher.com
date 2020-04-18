#!/bin/bash
docker stop portfolio
docker rm portfolio
docker run -d --name portfolio -p 8888:80 $PORTFOLIO_SITE_IMAGE_REPO/$PORTFOLIO_SITE_IMAGE:$PORTFOLIO_SITE_IMAGE_TAG
