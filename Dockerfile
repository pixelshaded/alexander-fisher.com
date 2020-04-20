ARG PORTFOLIO_SITE_IMAGE_REPO
ARG PORTFOLIO_SITE_DEPENDENCIES_IMAGE
ARG PORTFOLIO_SITE_DEPENDENCIES_IMAGE_TAG

FROM ${PORTFOLIO_SITE_IMAGE_REPO}/${PORTFOLIO_SITE_DEPENDENCIES_IMAGE}:${PORTFOLIO_SITE_DEPENDENCIES_IMAGE_TAG}

WORKDIR /portfolio-site

COPY . .

RUN set -x \
 && service mysql start \
 && mysql -e "CREATE DATABASE portfolio;" \
 && mysql -e "CREATE USER 'portfolio'@'localhost' IDENTIFIED BY 'portfolio_pass';" \
 && mysql -e "GRANT SELECT ON portfolio.* TO 'portfolio'@'localhost';" \
 ## required for admin section
# && mysql -e "GRANT UPDATE ON portfolio.* TO 'portfolio'@'localhost';" \
 ## required for admin section and registering users
# && mysql -e "GRANT INSERT ON portfolio.* TO 'portfolio'@'localhost';" \
 && mysql -e "FLUSH PRIVILEGES;" \
 && mysql portfolio < portfolio-site-dump.sql \
 && rm portfolio-site-dump.sql \
 && cp -r docker/. / \
 && rm -rf docker \
 && cp -r /portfolio-dependencies/. /portfolio-site \
 && cp app/config/parameters-dist.yml app/config/parameters.yml \
 && composer run-script post-install-cmd-manual \
 && php app/console cache:clear --env=prod \
 # note that app/cache and web/media need to be writable by www-data
 && chown -R www-data:www-data .

EXPOSE 80

CMD service apache2 start && service mysql start && tail -f /dev/null

