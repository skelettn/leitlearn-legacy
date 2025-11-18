# Colors for display
BLUE := \033[0;34m
GREEN := \033[0;32m
NC := \033[0m # No Color

up:
	@echo "$(BLUE)Starting containers...$(NC)"
	docker compose up -d
	@echo "$(GREEN)✓ App available at http://localhost:8080$(NC)"

down:
	@echo "$(BLUE)Stopping containers...$(NC)"
	docker compose down

restart: down up

build:
	@echo "$(BLUE)Rebuilding containers...$(NC)"
	docker compose up -d --build

logs:
	docker logs -f leitlearn-php

shell:
	docker exec -it leitlearn-php bash

db-migrate:
	@echo "$(BLUE)Running migrations...$(NC)"
	docker exec leitlearn-php bin/cake migrations migrate
	@echo "$(GREEN)✓ Migrations completed$(NC)"

db-status:
	docker exec leitlearn-php bin/cake migrations status

webpack-build:
	@echo "$(BLUE)Building webpack assets...$(NC)"
	docker exec leitlearn-php npx webpack --mode production
	@echo "$(GREEN)✓ Assets built$(NC)"

webpack-watch:
	@echo "$(BLUE)Starting webpack in watch mode...$(NC)"
	docker exec -it leitlearn-php npx webpack --mode development --watch

clean:
	@echo "$(BLUE)Cleaning...$(NC)"
	docker compose down -v
	rm -rf node_modules vendor tmp/cache/*
	@echo "$(GREEN)✓ Cleanup completed$(NC)"

install:
	@echo "$(BLUE)Installing the project...$(NC)"
	docker compose up -d --build
	@echo "$(BLUE)Waiting for services to start...$(NC)"
	sleep 5
	docker exec leitlearn-php composer install
	docker exec leitlearn-php npm install
	docker exec leitlearn-php npx webpack --mode production
	docker exec leitlearn-php bin/cake migrations migrate
	@echo "$(GREEN)✓ Installation completed!$(NC)"
	@echo "$(GREEN)✓ App available at http://localhost:8080$(NC)"