FROM afisher-symfony-environment:1.0 as composer_install

ARG composer_auth

WORKDIR /portfolio-site

COPY . .

RUN apt-get update && \
    apt-get install -y git unzip && \
    chmod +x composer_install.sh && \
    ./composer_install.sh && \
    mv composer.phar /usr/local/bin/composer && \
    cp app/config/parameters-dist.yml app/config/parameters.yml && \
    export COMPOSER_AUTH=$composer_auth && \
    composer install && \
    php app/console cache:clear --env=prod

FROM afisher-symfony-environment:1.0

WORKDIR /portfolio-site

COPY --from=composer_install /portfolio-site /portfolio-site

RUN service mysql start && \
    mysql -e "CREATE DATABASE portfolio;" && \
    mysql -e "CREATE USER 'portfolio'@'localhost' IDENTIFIED BY 'portfolio_pass';" && \
    mysql -e "GRANT SELECT ON portfolio.* TO 'portfolio'@'localhost';" && \
    mysql -e "GRANT UPDATE ON portfolio.* TO 'portfolio'@'localhost';" && \
    mysql -e "FLUSH PRIVILEGES;" && \
    mysql portfolio < portfolio-site-dump.sql && \
    cp -r docker/. / && \
    rm -rf /var/www/html && \
    ln -s /portfolio-site/web /var/www/html && \
    mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load && \
    chown -R www-data:www-data .

CMD service apache2 start && service mysql start && tail -f /dev/null

