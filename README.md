# PHP Password Manager (ppma) [![Build Status](https://travis-ci.org/pklink/ppma.svg?branch=1.0.0)](https://travis-ci.org/pklink/ppma) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pklink/ppma/badges/quality-score.png?b=1.0.0)](https://scrutinizer-ci.com/g/pklink/ppma/?branch=1.0.0)

## Installation

```sh
cp .env.example .env
vim .env
composer install
bower install
php artisan migrate
php -S localhost:8080 -t ./public/
```

## License

The PHP Password Manager (ppma) is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
