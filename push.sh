#!/bin/bash
docker cp ~/development/repos/alexander-fisher.com/app/. portfolio:/portfolio-site/app
docker cp ~/development/repos/alexander-fisher.com/src/. portfolio:/portfolio-site/src
docker cp ~/development/repos/alexander-fisher.com/dependencies/vendor-tweaks/. portfolio:/portfolio-site/vendor
