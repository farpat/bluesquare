.DEFAULT_GOAL   = help

include .env

PRIMARY_COLOR   		= \033[0;34m
PRIMARY_COLOR_BOLD   	= \033[1;34m

SUCCESS_COLOR   		= \033[0;32m
SUCCESS_COLOR_BOLD   	= \033[1;32m

DANGER_COLOR    		= \033[0;31m
DANGER_COLOR_BOLD    	= \033[1;31m

WARNING_COLOR   		= \033[0;33m
WARNING_COLOR_BOLD   	= \033[1;33m

NO_COLOR      			= \033[m

# For test
mariadb_test = docker-compose -f docker-compose-test.yaml exec mariadb mysql -psecret -e
php_test = docker-compose -f docker-compose-test.yaml exec php php

# For dev
php = docker-compose -f docker-compose-dev.yaml run --rm php php
bash_root = docker-compose -f docker-compose-dev.yaml run --user=root --rm php bash
bash = docker-compose -f docker-compose-dev.yaml run --rm php bash
composer = docker-compose -f docker-compose-dev.yaml run --rm php composer
npm = docker-compose -f docker-compose-dev.yaml run --rm asset_dev_server npm


node_modules: package.json
	@$(npm) install

vendor: composer.json
	@$(composer) install

.PHONY:install
install: vendor node_modules ## Install the composer dependencies, npm dependencies, and setup project
	@$(php) artisan migrate:fresh --seed

.PHONY:update
update:
	@$(npm) install
	@$(composer) update

.PHONY:help
help: ## Display this help
	@awk 'BEGIN {FS = ":.*##"; } /^[a-zA-Z_-]+:.*?##/ { printf "$(PRIMARY_COLOR_BOLD)%-15s$(NO_COLOR) %s\n", $$1, $$2 }' $(MAKEFILE_LIST) | sort

.PHONY:dev
dev: ## Run development servers
	@docker-compose -f docker-compose-dev.yaml up -d
	@echo "Dev server launched on http://localhost:$(DOCKER_NGINX_PORT)"
	@echo "Asset dev server launched on http://localhost:3000"

.PHONY:stop-dev
stop-dev: ## Stop development servers
	@docker-compose -f docker-compose-dev.yaml down
	@echo "Dev server stopped: http://localhost:$(DOCKER_NGINX_PORT)"
	@echo "Asset dev server stopped: http://localhost:3000"

.PHONY:build
build: ## Build assets projects for production
	@rm -rf ./public/assets/*
	@$(npm) run build

.PHONY:bash
bash: ## Run bash in PHP container
ifeq ($(ROOT),1)
	@$(bash_root)
else
	@$(bash)
endif

.PHONY:test
test: ## Run tests
	@make stop-dev
	@docker-compose -f docker-compose-test.yaml up -d
	@$(mariadb_test) "drop database if exists bluesquare_test; create database bluesquare_test;"
	@$(php_test) vendor/bin/phpunit --testdox
	@$(mariadb_test) "drop database if exists bluesquare_test;"
	@docker-compose -f docker-compose-test.yaml down

.PHONY:lint-php
lint-php: ## Lint PHP
	@$(php) ./vendor/bin/phpstan analyze --memory-limit=2G

.PHONY:lint-php-generate-baseline
lint-php-generate-baseline: ## Lint PHP
	@$(php) ./vendor/bin/phpstan analyze --generate-baseline
