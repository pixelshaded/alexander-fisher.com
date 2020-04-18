#!/bin/bash
source ./setenv.sh
./environment/build.sh
./dependencies/build.sh
./build.sh
./environment/publish.sh
./dependencies/publish.sh
docker push $PORTFOLIO_SITE_IMAGE_REPO/$PORTFOLIO_SITE_IMAGE:$PORTFOLIO_SITE_IMAGE_TAG
