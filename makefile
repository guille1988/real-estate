format-seeder-images:
	@echo Formatting seeder images...
	@./vendor/bin/sail artisan format:seeder-images

migrate-seed:
	@echo Running migration and seeders...
	@./vendor/bin/sail artisan migrate:fresh --seed

clear:
	@echo Clearing all types of cache...
	@./vendor/bin/sail artisan clear:all
	clear

test:
	@echo Running tests...
	@./vendor/bin/sail composer test

update:
	@echo Running composer update...
	@./vendor/bin/sail composer update

al: format-seeder-images migrate-seed clear

all: format-seeder-images migrate-seed test clear

whole: update all

init:
	@echo Initiating...
	@./vendor/bin/sail up -d
	make whole
	@./vendor/bin/sail npm run dev