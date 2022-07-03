FROM php:7.4-cli
COPY . /usr/src/myapp
CMD [ "php", "./index.php" ]
RUN brew install libxml2
RUN docker-php-ext-install mysqli pdo pdo_mysql soap
RUN apt-get update && apt-get upgrade -y
RUN git clone -b php7 https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached \ && docker-php-ext-configure /usr/src/php/ext/memcached \ --disable-memcached-sasl \ && docker-php-ext-install /usr/src/php/ext/memcached \ && rm -rf /usr/src/php/ext/memcached
RUN apt-get update && apt-get install -y libxml2-dev
RUN docker-php-ext-install soap
RUN apt-get install libxml2-dev
# Update OS and install common dev tools
RUN apt-get update
RUN apt-get install -y wget vim git zip unzip zlib1g-dev libzip-dev libpng-dev
 
# Install PHP extensions needed
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql gd zip pcntl exif
 
#RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
#RUN a2enmod rewrite
#RUN apachectl restart
