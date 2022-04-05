FROM registry.gitlab.com/oxycreative/php:7.4
LABEL maintainer="Budi Prih Hastomo <budi.hastomo@karyaks.com>"

COPY . /tmp/appbuild
COPY .build/start-optimize /start-optimize

RUN rsync -ah \
        --exclude /.bash_history \
        --exclude /.buildpacks \
        --exclude /.composer \
        --exclude /.env \
        --exclude /.heroku \
        --exclude /.profile.d \
        --exclude /.release \
        --exclude /vendor \
        /tmp/appbuild/ /app --delete \
    && chown -R herokuishuser:herokuishuser /app \
    && /exec composer install --optimize-autoloader --no-dev \
    && /exec composer dumpautoload -o \
    && /exec php artisan route:clear \
    && /exec php artisan config:clear \
    && /exec php artisan view:clear \
    && /exec php artisan optimize:clear \
    && /exec php artisan storage:link \
    && rm -rf /tmp/appbuild

CMD ["/start-optimize", "web"]
