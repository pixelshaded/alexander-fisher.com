#!/bin/bash
docker stop dependencies
docker rm dependencies
docker run -d --name dependencies $PORTFOLIO_SITE_IMAGE_REPO/$PORTFOLIO_SITE_DEPENDENCIES_IMAGE:$PORTFOLIO_SITE_DEPENDENCIES_IMAGE_TAG
