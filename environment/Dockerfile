FROM debian:stretch-slim

WORKDIR /portfolio-environment

RUN apt-get update && \
    apt-get install -y \
    ### Deps for adding a new source
    wget apt-transport-https lsb-release ca-certificates && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list && \
    apt-get update && \
    apt-get install -y \
    ### Lamp Stack
    apache2 \
    php5.6-fpm php5.6-dev php5.6-zip php5.6-curl php5.6-xmlrpc php5.6-gd php5.6-mysql php5.6-mbstring php5.6-xml libapache2-mod-php5.6 \
    default-mysql-server && \
    php -r 'echo "\nYour PHP installation is working fine.\n";'
