FROM php:8.4-apache

# Run apt update and install some dependancies needed for docker-php-ext
RUN apt-get update
RUN apt-get install -y curl postgresql postgresql-client libsodium-dev apt-utils sendmail mariadb-client \
    pngquant libpq-dev unzip zip libpng-dev libgmp-dev libmcrypt-dev git curl libicu-dev libxml2-dev  \
    libssl-dev sqlite3 build-essential \
                           libjpeg62-turbo-dev \
                           libfreetype6-dev \
                           locales \
                           jpegoptim optipng pngquant gifsicle \
                           lua-zlib-dev \
                           libmemcached-dev

# Install PHP extensions
RUN docker-php-ext-install sockets bcmath sodium gmp exif mysqli gd intl xml pdo pdo_mysql pdo_pgsql pgsql dom session opcache

# Update web root to public
# See: https://hub.docker.com/_/php#changing-documentroot-or-other-apache-configuration
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable mod_rewrite
RUN a2enmod rewrite

# Права пользователя от которого запускаем docker
USER 1000:1000
