FROM debian:jessie

MAINTAINER Sergey Cherkesov <go.for.broke1006@gmail.com>

RUN apt-get update

RUN apt-get install -y git wget curl zsh htop

RUN echo 'deb http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list
RUN echo 'deb-src http://packages.dotdeb.org jessie all' >> /etc/apt/sources.list
RUN wget https://www.dotdeb.org/dotdeb.gpg
RUN apt-key add dotdeb.gpg
RUN apt-get update

RUN echo "mysql-server-5.5 mysql-server/root_password password 123456" | debconf-set-selections
RUN echo "mysql-server-5.5 mysql-server/root_password_again password 123456" | debconf-set-selections
RUN apt-get -y install mysql-server-5.5
RUN service mysql start

RUN apt-get install -y php7.0
RUN apt-get install -y php7.0-mysql php7.0-sqlite3
RUN apt-get install -y php7.0-pdo php7.0-bcmath php7.0-mbstring php7.0-dom php7.0-intl php7.0-curl
RUN apt-get install -y php7.0-gd

RUN apt-get install -y php-pear
RUN apt-get install -y php7.0-dev


RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN composer --version

EXPOSE 8080

COPY ./ /code
WORKDIR /code

RUN rm -f app/logs/*.log
RUN rm -rf app/cache/dev/ app/cache/prod/ app/cache/test/
RUN rm -rf vendor/

CMD composer install --no-dev
CMD php app/console doctrine:database:create --if-not-exists
CMD php app/console doctrine:schema:update --force

ENTRYPOINT service mysql start && php app/console server:start 127.0.0.1:8080