FROM debian:stretch-slim

WORKDIR /portfolio-environment

COPY composer_install.sh .

RUN set -x \
 && apt-get update \
 && apt-get install -y --no-install-recommends \
    apt-transport-https \
    ca-certificates \
    lsb-release \
    wget \
 && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
 && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list \
 && apt-get update \
 && apt-get install -y --no-install-recommends \
    apache2 \
    # default server sounds like a non prod version. Verify its ok to use this in prod.
    default-mysql-server \
    # So apache2 can load php as a module
    libapache2-mod-php5.6 \
    # needed for development...should this be part of the root image?
    # php5.6-dev \
    # Liip Imagine uses gd as image manipulation driver
    php5.6-gd \
    # Related to handling multibyte encoding of strings. i.e. UTF8 is not multibyte, aka 1 byte per character.
    # php5.6-mbstring \
    # Remove from php7. Deprecated php5.5.0. Suggest using mysqli or PDO_MySQL extension
    php5.6-mysql \
    # Smyfony's dependency injection depends on XmlFileLoader
    php5.6-xml \
 && php -r 'echo "\nYour PHP installation is working fine.\n";' \
 && mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load \
 && chmod +x composer_install.sh \
 && ./composer_install.sh \
 && mv composer.phar /usr/local/bin/composer
 && mkdir -p /var/tmp

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
