FROM alpine

RUN apk add --update --no-cache postgresql-client

RUN rm -rf /var/cache/apk/* /tmp/*

COPY scripts/non_live_seeding /app

WORKDIR /app

CMD chmod +x seed_environment.sh && ./seed_environment.sh
