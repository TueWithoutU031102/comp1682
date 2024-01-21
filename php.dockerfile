FROM php:8.2-cli as base

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install zip

RUN docker-php-ext-install opcache mbstring pdo pdo_mysql mysqli

RUN echo '\
opcache.interned_strings_buffer=16\n\
opcache.load_comments=Off\n\
opcache.max_accelerated_files=16000\n\
opcache.save_comments=Off\n\
' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini


FROM base as installer

ADD composer.json /setup/composer.json
ADD composer.lock /setup/composer.lock

WORKDIR /setup

RUN composer -v --no-plugins --no-scripts
RUN composer install --no-dev --no-interaction --no-plugins --no-scripts

FROM base as runner

COPY --from=installer /setup/vendor /app/vendor
COPY . /app

WORKDIR /app

EXPOSE 8000

CMD php artisan serve --host 0.0.0.0 --port 8000