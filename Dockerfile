FROM php:7.0-apache
RUN apt-get update && apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql
ARG ARG_APACHE_LISTEN_PORT=8001
ENV APACHE_LISTEN_PORT=${ARG_APACHE_LISTEN_PORT}
COPY index.php /var/www/html/
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -s -i -e "s/80/${APACHE_LISTEN_PORT}/" /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf
USER www-data
EXPOSE ${APACHE_LISTEN_PORT}

