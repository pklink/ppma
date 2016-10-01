# PHP Password Manager (ppma) [![Build Status](https://travis-ci.org/pklink/ppma.svg?branch=1-slim)](https://travis-ci.org/pklink/ppma) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pklink/ppma/badges/quality-score.png?b=1-slim)](https://scrutinizer-ci.com/g/pklink/ppma/?branch=1-slim)

## Installation

```sh
cp config.sample.php config.php
vim config.php
composer install
./vendor/bin/phinx migrate
./vendor/bin/phinx seed:run
php -S localhost:8080 -t ./public/
```

## License

The PHP Password Manager (ppma) is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
