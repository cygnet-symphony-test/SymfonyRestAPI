#!/bin/sh

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php composer.phar update -v
php bin/console server:stop
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console cache:clear --env=prod
php bin/console cache:clear --env=dev
mkdir -p app/config/jwt
openssl genrsa -out app/config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in app/config/jwt/private.pem -out app/config/jwt/public.pem
cp phpunit.xml.dist phpunit.xml
./vendor/bin/phpunit
php bin/console server:start 127.0.0.1:8090
