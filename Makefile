build:
	docker-compose build
	docker-compose up -d
	docker-compose exec www bash -c "cd api && \
		composer require symfony/runtime && \
		php bin/console make:migration && \
		php bin/console doctrine:schema:update --force && \
		php bin/console doctrine:migrations:migrate"

start:
	docker-compose up -d

stop:
	docker-compose down

restart: stop start