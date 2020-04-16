FROM pixelshaded/symfony-environment:1.1 as composer_install

ARG composer_auth

WORKDIR /portfolio-dependencies

COPY composer.json .
COPY composer.lock .

RUN set -x \
 && apt-get update \
 && apt-get install -y git unzip \
 && export COMPOSER_AUTH=$composer_auth \
 && composer install

FROM pixelshaded/symfony-environment:1.1

WORKDIR /portfolio-dependencies

COPY --from=composer_install /portfolio-dependencies /portfolio-dependencies

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
