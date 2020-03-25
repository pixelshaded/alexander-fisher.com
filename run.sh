#!/bin/bash
docker rm portfolio
docker run -i -t --entrypoint /bin/bash --name portfolio afisher-symfony:1.0
