.DEFAULT_GOAL := help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

rebuild: down build up composer-install web-run ## rebuild docker containers with dependencies and run web

down:
	docker-compose down --remove-orphans

build:
	docker-compose build

up:
	docker-compose up -d

composer-install: ## install backend dependencies
	docker-compose exec php-tc composer install

web-run: ## run the web-server on port 8000
	docker-compose exec php-tc symfony server:start

test-run: ## run phpunit tests
	docker-compose exec php-tc php bin/phpunit