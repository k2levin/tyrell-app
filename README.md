# Tyrell App

[![PHP](https://img.shields.io/badge/php-%5E8.1-blue)](https://www.php.net/releases/8.1/en.php)

### setup for backend local development

- create file **.env** from **.env.example**
- start server with `docker compose -f ./dockerfiles/docker-compose.yaml --env-file ./backend/.env up -d`
- remote server with `docker exec -it app sh`
- run with `composer install`
- run with `php artisan migrate --seed`
- browse server at http://127.0.0.1:8080/ (backend php-fpm)
- browse server at http://127.0.0.1:8081/ (frontend)
- shutdown server with `docker compose -f ./dockerfiles/docker-compose.yaml --env-file ./backend/.env down`
- rebuild image with `docker compose -f ./dockerfiles/docker-compose.yaml --env-file ./backend/.env build`

### Tools

- use **Adminer** to connect to database at http://127.0.0.1:8082/

### API url

- http://127.0.0.1:8080/api/info
- http://127.0.0.1:8080/api/shuffle-card
