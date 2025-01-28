#!/bin/bash

nice -n 10 sleep 60 && php /var/www/artisan schedule:run --verbose --no-interaction
