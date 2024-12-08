FROM php:8.3.10

RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_sqlite

RUN php -m | grep mbstring

WORKDIR /app

COPY . .

RUN chmod -R 777 .
RUN chown -R www-data:www-data .

RUN composer install

RUN php artisan key:generate

RUN php artisan migrate

RUN php artisan db:seed

RUN composer dump-autoload

CMD php artisan serve --host=0.0.0.0

EXPOSE 8010
