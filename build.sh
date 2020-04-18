#!/bin/bash
docker build \
--tag $PORTFOLIO_SITE_IMAGE_REPO/$PORTFOLIO_SITE_IMAGE:$PORTFOLIO_SITE_IMAGE_TAG \
--build-arg PORTFOLIO_SITE_IMAGE_REPO=$PORTFOLIO_SITE_IMAGE_REPO \
--build-arg PORTFOLIO_SITE_DEPENDENCIES_IMAGE=$PORTFOLIO_SITE_DEPENDENCIES_IMAGE \
--build-arg PORTFOLIO_SITE_DEPENDENCIES_IMAGE_TAG=$PORTFOLIO_SITE_DEPENDENCIES_IMAGE_TAG \
.
