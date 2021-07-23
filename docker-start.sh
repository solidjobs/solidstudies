docker-compose up -d
docker exec docker-php /bin/bash docker-php-ext-install pdo pdo_mysql
docker exec -it docker-php /bin/bash
