FROM debian:stretch-slim

WORKDIR /portfolio-environment

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    ### Deps for adding a new source
    wget apt-transport-https lsb-release ca-certificates && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
    # Composer Deps
    apache2 \
    # needed for development...should this be part of the root image?
    # php5.6-dev \
    # Liip Imagine uses gd as image manipulation driver
    php5.6-gd \
    # Remove from php7. Deprecated php5.5.0. Suggest using mysqli or PDO_MySQL extension
    php5.6-mysql \
    # Related to handling multibyte encoding of strings. i.e. UTF8 is not multibyte, aka 1 byte per character.
    # php5.6-mbstring \
    # Smyfony's dependency injection depends on XmlFileLoader
    php5.6-xml \
    # So apache2 can load php as a module
    libapache2-mod-php5.6 \
    # default server sounds like a non prod version. Verify its ok to use this in prod.
    default-mysql-server && \
    php -r 'echo "\nYour PHP installation is working fine.\n";'
