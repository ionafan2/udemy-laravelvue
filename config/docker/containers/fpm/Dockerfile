FROM php:8.0.19-fpm

RUN apt-get update \
    && apt-get install -y \
        libmcrypt-dev \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        libxslt-dev \
        libicu-dev \
        git \
        vim \
        unzip

# Better shell client
RUN apt-get -y install fish

# Install nodejs
#RUN apt-get -y install curl
#RUN curl -sL https://deb.nodesource.com/setup_18.x  | bash -
#RUN apt-get -y install nodejs

RUN pecl install xdebug apcu mcrypt redis

RUN docker-php-ext-install \
        gd \
        exif \
        zip \
        opcache \
        pdo \
        pdo_mysql \
        mysqli \
        sockets \
        xsl \
        intl

RUN docker-php-ext-enable \
        xdebug \
        apcu \
        mcrypt \
        pdo_mysql \
        redis

# Setup xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.trigger_value=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.file_link_format=\"phpstorm://open?file=%f&line=%l\"" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Update Php Settings
RUN sed -E -i -e 's/max_execution_time = 30/max_execution_time = 120/' /usr/local/etc/php/php.ini \
 && sed -E -i -e 's/memory_limit = 128M/memory_limit = 512M/' /usr/local/etc/php/php.ini \
 && sed -E -i -e 's/post_max_size = 8M/post_max_size = 64M/' /usr/local/etc/php/php.ini \
 && sed -E -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 64M/' /usr/local/etc/php/php.ini

# Install Composer
RUN cd /tmp && curl -sS https://getcomposer.org/installer | php && \
    mv /tmp/composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

EXPOSE 9000
