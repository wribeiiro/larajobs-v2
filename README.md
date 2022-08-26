# larajobs-v2

Build docker containers, enter in root folder `larajobs-v2` and execute the command below:

```bash
$ docker-compose -f "./docker-compose.yml" up -d --build
```

The endpoint for backend `http://localhost:8001`

Access PHP container, and execute commands like below:

```bash
$ docker exec php-larajobs composer install
$ docker exec php-larajobs php artisan key:generate
$ docker exec php-larajobs php artisan migrate:fresh --seed
$ docker exec php-larajobs php artisan serve
```

The endpoint for frontend `http://localhost:8080`

Access VueJS container, and execute commands like below:

```bash
$ docker exec vue-larajobs npm install
$ docker exec vue-larajobs npm run serve
```