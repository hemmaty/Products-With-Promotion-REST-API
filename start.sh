#!/bin/bash
cd $PWD;

echo "Update Composer! \r\n";
php composer.phar update;

echo "Apply Migration! \r\n";
php artisan migrate

echo "Apply Data! \r\n";
php artisan db:seed;

echo "Apply Promotions! \r\n";
php artisan promotion:apply

echo "Start Servers! \r\n";
php -S localhost:8000 -t public
