build:
	docker-compose build
	docker-compose up -d
	docker-compose exec php-fpm bash -c "composer require symfony/runtime && \
		php bin/console make:migration && \
		php bin/console doctrine:schema:update --force && \
		php bin/console doctrine:migrations:migrate"

start:
	docker-compose up -d

stop:
	docker-compose stop

delete:
	docker-compose down -v --rmi all --remove-orphans

restart: stop start

fixtures:
	docker-compose exec php-fpm bash -c "php bin/console doctrine:fixtures:load"

jwt:
	docker compose exec php-fpm sh -c "set -e && \
	apt-get install openssl && \
	php bin/console lexik:jwt:generate-keypair --overwrite"