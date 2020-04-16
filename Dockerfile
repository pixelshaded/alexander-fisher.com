FROM pixelshaded/symfony-dependencies:1.1

WORKDIR /portfolio-site

COPY . .

RUN set -x \
 && service mysql start \
 && mysql -e "CREATE DATABASE portfolio;" \
 && mysql -e "CREATE USER 'portfolio'@'localhost' IDENTIFIED BY 'portfolio_pass';" \
 && mysql -e "GRANT SELECT ON portfolio.* TO 'portfolio'@'localhost';" \
 && mysql -e "GRANT UPDATE ON portfolio.* TO 'portfolio'@'localhost';" \
 && mysql -e "FLUSH PRIVILEGES;" \
 && mysql portfolio < portfolio-site-dump.sql \
 && cp -r docker/. / \
 && cp -r /portfolio-dependencies/. /portfolio-site \
 && cp app/config/parameters-dist.yml app/config/parameters.yml \
 && composer run-script post-install-cmd-manual \
 && php app/console cache:clear --env=prod \
 && chown -R www-data:www-data .

EXPOSE 80

CMD service apache2 start && service mysql start && tail -f /dev/null

