# client

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
## bdd-user : root
## exec in cmdline
docker exec -it CONTAINER ID 2fd17b35cb188e8a89eaeb41b2d3914b0a795d225550c4c98571652cf293dfbb /bin/sh

## mise à jour in it
composer require symfony/runtime

###make entity
php bin/console make:entity
### create a migration
php bin/console make:migration
## migration
php bin/console doctrine:migrations:migrate

### mise a jour bdd
php bin/console doctrine:schema:update --force

## load fixtures
php bin/console doctrine:fixtures:load

## make controller
php bin/console make:controller

## install serialiser for data
composer require symfony/serialiser-pack

