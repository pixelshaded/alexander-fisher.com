###################
### registry.docker.com
###################

FROM afisher-symfony-environment:1.0

WORKDIR /portfolio-site

COPY . .

RUN service mysql start && \
    mysql -e "CREATE DATABASE portfolio;" && \
    mysql -e "CREATE USER 'portfolio'@'localhost' IDENTIFIED BY 'portfolio_pass';" && \
    mysql -e "GRANT SELECT ON portfolio.* TO 'portfolio'@'localhost';" && \
    mysql -e "GRANT UPDATE ON portfolio.* TO 'portfolio'@'localhost';" && \
    mysql -e "FLUSH PRIVILEGES;" && \
    mysql portfolio < portfolio-site-dump.sql && \
    cp app/config/parameters-dist.yml app/config/parameters.yml && \
    cp -r docker/. / && \
    rm -rf /var/www/html && \
    ln -s /portfolio-site/web /var/www/html && \
    mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load && \
    chown -R www-data:www-data .

