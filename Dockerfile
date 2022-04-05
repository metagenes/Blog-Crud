FROM registry.gitlab.com/oxycreative/php:7.3
LABEL maintainer="Rendi Kasigi <rendi@gixbox.com>"

COPY . /tmp/appbuild

RUN --mount=type=cache,target=/app/.composer/cache \
    rsync -ah \
        --exclude .bash_history \
        --exclude .buildpacks \
        --exclude .composer \
        --exclude .env \
        --exclude .heroku \
        --exclude .profile.d \
        --exclude .release \
        --exclude vendor \
        /tmp/appbuild/ /app --delete \
    && chown herokuishuser:herokuishuser /app \
    && /exec composer install \
    && rm -rf /tmp/appbuild
