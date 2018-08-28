ARG CLI_IMAGE
FROM ${CLI_IMAGE} as cli

FROM amazeeio/php:7.2-fpm

# Install needed php extensions: ldap
RUN \
    apk update && \
    apk add openldap-dev && \
    rm -rf /var/cache/apk/* && \
    docker-php-ext-configure ldap --with-libdir=lib/ && \
    docker-php-ext-install ldap

COPY --from=cli /app /app
