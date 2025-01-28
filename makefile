migrate-seed:
	@echo Running migration and seeders...
	@./vendor/bin/sail artisan migrate:fresh --seed

clear:
	@echo Clearing all types of cache...
	@./vendor/bin/sail artisan clear:all

test:
	@echo Running tests...
	@./vendor/bin/sail composer test

update:
	@echo Running composer update...
	@./vendor/bin/sail composer update

al: migrate-seed clear

all: migrate-seed test clear

whole: update all

