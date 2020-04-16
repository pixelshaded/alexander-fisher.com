FROM pixelshaded/symfony-environment:1.1 as composer_install

ARG composer_auth

WORKDIR /portfolio-site

COPY . .

RUN set -x \
 && apt-get update \
 && apt-get install -y git \
 && cp app/config/parameters-dist.yml app/config/parameters.yml \
 && export COMPOSER_AUTH=$composer_auth \
 && composer install \
 && php app/console cache:clear --env=prod

FROM pixelshaded/symfony-environment:1.1

WORKDIR /portfolio-site

COPY --from=composer_install /portfolio-site /portfolio-site

RUN set -x \
 && service mysql start \
 && mysql -e "CREATE DATABASE portfolio;" \
 && mysql -e "CREATE USER 'portfolio'@'localhost' IDENTIFIED BY 'portfolio_pass';" \
 && mysql -e "GRANT SELECT ON portfolio.* TO 'portfolio'@'localhost';" \
 && mysql -e "GRANT UPDATE ON portfolio.* TO 'portfolio'@'localhost';" \
 && mysql -e "FLUSH PRIVILEGES;" \
 && mysql portfolio < portfolio-site-dump.sql \
 && cp -r docker/. / \
 && chown -R www-data:www-data .

CMD service apache2 start && service mysql start && tail -f /dev/null

