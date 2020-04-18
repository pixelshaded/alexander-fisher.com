ARG PORTFOLIO_SITE_IMAGE_REPO
ARG PORTFOLIO_SITE_ENVIRONMENT_IMAGE
ARG PORTFOLIO_SITE_ENVIRONMENT_IMAGE_TAG

FROM ${PORTFOLIO_SITE_IMAGE_REPO}/${PORTFOLIO_SITE_ENVIRONMENT_IMAGE}:${PORTFOLIO_SITE_ENVIRONMENT_IMAGE_TAG} as composer_install

ARG composer_auth

WORKDIR /portfolio-dependencies

COPY . .

RUN set -x \
 && apt-get update \
 && apt-get install -y git unzip \
 && export COMPOSER_AUTH=$composer_auth \
 && composer install \
 && cp -r vendor-tweaks/. vendor

FROM ${PORTFOLIO_SITE_IMAGE_REPO}/${PORTFOLIO_SITE_ENVIRONMENT_IMAGE}:${PORTFOLIO_SITE_ENVIRONMENT_IMAGE_TAG}

WORKDIR /portfolio-dependencies

COPY --from=composer_install /portfolio-dependencies /portfolio-dependencies

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
