FROM php:alpine

ENV NGROK_FILE=ngrok-v3-stable-linux-amd64.tgz

RUN wget "https://bin.equinox.io/c/bNyj1mQVY4c/$NGROK_FILE" \
    && tar xvzf $NGROK_FILE -C /usr/local/bin \
    && rm $NGROK_FILE

COPY . /src

CMD php -S 0.0.0.0:5774 -t /src
