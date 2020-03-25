FROM debian:buster

WORKDIR /portfolio-environment

COPY composer_install.sh .

RUN apt-get update && \
    apt-get install -y \
    ### Composer Dependencies - wget for install script, git and unzip for downloading dependencies with composer
    wget git unzip \
    ### Lamp Stack
    apache2 php-pear php-fpm php-dev php-zip php-curl php-xmlrpc php-gd php-mysql php-mbstring php-xml libapache2-mod-php default-mysql-server && \
    php -r 'echo "\nYour PHP installation is working fine.\n";' && \
    chmod +x composer_install.sh && \
    ./composer_install.sh && \
    mv composer.phar /usr/local/bin/composer