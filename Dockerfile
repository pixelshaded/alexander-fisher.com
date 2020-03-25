###################
### registry.docker.com
###################

FROM afisher-symfony-environment:1.0

WORKDIR /portfolio-site

COPY . .

RUN apt-get update && apt-get -y install git && \
    service mysql start && \
    mysql -e 'CREATE DATABASE portfolio;' && \
    mysql portfolio < portfolio-site-dump.sql && \
    cp app/config/parameters-dist.yml app/config/parameters.yml
