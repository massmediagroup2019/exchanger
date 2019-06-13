##Set up

```bash
$ cp ./.env.dist ./.env
$ docker-compose up -d
$ docker-compose exec php bin/console d:d:c
$ docker-compose exec php bin/console d:m:m
```

##Run
`docker-compose up -d`

And go to http://localhost:8000

##Test
`docker-compose exec php bin/phpunit`
