FROM webdevops/php-nginx:8.1

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV WEB_DOCUMENT_ROOT /app/public

WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader

COPY entrypoint.sh /opt/docker/provision/entrypoint.d/
COPY supervosord-horizon.conf /opt/docker/etc/supervisor.d/

RUN php artisan storage:link && php artisan optimize && php artisan key:generate

RUN chown -R application:application storage bootstrap/cache
