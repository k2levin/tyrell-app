## dockerfiles

[![PHP](https://img.shields.io/badge/php-%5E8.1-blue)](https://www.php.net/releases/8.1/en.php)

### setup for local development

1. create file **.env** from **.env.example**
2. start server with `docker compose -f ./dockerfiles/docker-compose.yaml --env-file ./backend/.env up -d`
3. remote server with `docker exec -it app sh`
4. run with `composer install`
5. run with `php artisan migrate`
6. browse server at http://127.0.0.1:8080/ (backend php-fpm)
7. browse server at http://127.0.0.1:8081/ (frontend)
8. run with `php artisan test`
9. shutdown server with `docker compose -f ./dockerfiles/docker-compose.yaml --env-file ./backend/.env down`
10. rebuild image with `docker compose -f ./dockerfiles/docker-compose.yaml --env-file ./backend/.env build`

### Tools

1. use **Adminer** to connect to database at http://127.0.0.1:8082/
