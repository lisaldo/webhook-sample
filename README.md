# Rodar
```shell
docker-compose up -d
docker exec webhook-sample ngrok http 0.0.0.0:5774 --log stdout
```