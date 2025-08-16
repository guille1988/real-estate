format-seeder-images:
	@echo Formatting seeder images...
	@./vendor/bin/sail artisan format:seeder-images

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

al: format-seeder-images migrate-seed clear

all: al test

whole: update all

init:
	@echo Initiating...
	@./vendor/bin/sail up -d
	make whole
	@./vendor/bin/sail npm run dev