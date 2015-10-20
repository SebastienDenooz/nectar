# Nectar installation

### Requirements
- PHP 5.4
- PHP Mcrypt
- PHP PDO Compatible database driver
- [gulp](http://gulpjs.com/)

### Deployment
Tested on Ubuntu 14.04

**Install dependencies**
```
sudo apt-get install npm php5-mcrypt
sudo npm -g install gulp node bower
sudo ln -s /usr/bin/nodejs /usr/bin/node
```

**Install Nectar**
```
git clone https://github.com/SebastienDenooz/nectar.git
cd nectar
curl -sS https://getcomposer.org/installer | php
cp composer.phar composer
./composer install
cp .env.example .env
npm install
bower install
gulp --production
# At this time, you need to setup your .env correctly
php artisan migrate
```

**Update Nectar**
```
git pull origin master
./composer install
php artisan migrate
bower install
npm install
gulp --production
```