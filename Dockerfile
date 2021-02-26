FROM thecodingmachine/php:8.0-v4-apache

ENV TEMPLATE_PHP_INI="production"

ENV APACHE_DOCUMENT_ROOT="public/"

COPY . /var/www/html/
RUN sudo chown -R docker:docker /var/www/html/

RUN composer install --no-dev --no-interaction --no-progress --classmap-authoritative

VOLUME /var/www/html/
EXPOSE 80
