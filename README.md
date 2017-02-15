momentum test api
===

A Symfony project created on February 11, 2017, 3:32 pm.

1. In order to work on your server, please make sure that php5-cli, php5-curl, acl are installed.

2. install necessary Symfony libraries
composer install --no-dev --optimize-autoloader

3. create the data bases
php app/console doctrine:schema:validate
php app/console doctrine:schema:create

4. make sure that the web server has write permissions on
document_root/app/cache
document_root/app/logs
