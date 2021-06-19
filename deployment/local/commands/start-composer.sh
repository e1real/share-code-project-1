#!/bin/bash
# ----------------------------------------------------------------------
# Run Composer
# ----------------------------------------------------------------------

if [[ ! -d "/app/vendor" ]];
then
cd /app
composer install
composer dump-autoload -o
fi