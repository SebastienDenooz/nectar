# Nectar installation

### Requirements
- PHP 5.4
- PHP Mcrypt
- PHP PDO Compatible database driver
- [gulp](http://gulpjs.com/)

### Deployment
Tested on Ubuntu 14.04

**Dependencies**
```
sudo apt-get install npm php5-mcrypt
sudo npm -g install gulp node bower
sudo ln -s /usr/bin/nodejs /usr/bin/node
```

**Client part**
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