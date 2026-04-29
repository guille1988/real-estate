format-seeder-images:
	@echo Formatting seeder images...
	@./vendor/bin/sail artisan format:seeder-images

migrate-seed:
	@echo Running migration and seeders...
	@./vendor/bin/sail artisan migrate:fresh --seed

wayfinder:
	@echo Generating wayfinder routes and actions...
	@./vendor/bin/sail artisan wayfinder:generate --path=resources/js/Routes

clear:
	@echo Clearing all types of cache...
	@./vendor/bin/sail artisan clear:all

test:
	@echo Running tests...
	@./vendor/bin/sail composer test

update:
	@echo Running composer update...
	@./vendor/bin/sail composer update

al: format-seeder-images migrate-seed wayfinder clear

all: al test

whole: update all

init:
	@echo Initiating...
	@./vendor/bin/sail up -d
	make whole
	@./vendor/bin/sail npm run dev

build:
	@echo Building...
	@./vendor/bin/build --no-cache