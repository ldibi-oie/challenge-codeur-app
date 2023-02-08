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
	docker-compose down -v

restart: stop start

fixtures:
	docker-compose exec php-fpm bash -c "php bin/console doctrine:fixtures:load"