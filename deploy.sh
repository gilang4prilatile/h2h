#!/bin/bash
rm -rf .env &&
cp .env.develop .env &&
composer install &&
php artisan config:clear &&
php artisan view:clear
php artisan dev:generate:menu &&
php artisan migrate &&
php artisan config:clear &&
php artisan view:clear
