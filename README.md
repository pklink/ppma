# PHP Password Manager // ppma


## Requirements

* A webserver like Apache
* PHP 5.2 or higher
* MySQL 5.0 or higher

## More info / screenshots

You can find more info and screenshots at <http://sourceforge.net/projects/ppma/>

## Installation

1. uncompress the downloaded archive
2. upload the extracted files to your webserver
3. open the ppma-url in your browser (`<ppma-URL>/index.php`
   e.g. `http://example.com/index.php`)
4. follow the shown setup instructions

### Problems

If you have problems with the installation (e.g. a redirect loop) check that all directories are readable by
your webserver and the following directories are writable:

* `<ppma-directory>/assets`
* `<ppma-directory>/protected/runtime`
* `<ppma-directory>/protected/runtime/sessions`

For debugging uncomment the following lines in the index.php

    //defined('YII_DEBUG') or define('YII_DEBUG',true);
    //defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

Please report founded bugs on https://github.com/pklink/ppma/issues

### Building

It is not needed if you download the prebuilt release

```bash
git clone https://github.com/pklink/ppma.git
cd ppma/
composer install
npm install
./node_modules/.bin/bower install
./node_modules/.bin/grunt
```

## Upgrading

1. back up your database
2. unpack the downloaded ppma-archive
3. remove the extracted `/protected/config/ppma.php`
4. copy/overwrite the unpacked files to your ppma directory
5. run the upgrade routine in your browser
   (`<ppma-URL>/index.php?r=upgrade` e.g. `http://example.com/index.php?r=upgrade`)


## Credits

* [Yii Framework](http://www.yiiframework.com/)
* [Bootstrap](http://twitter.github.io/bootstrap/)
* [jQuery](http://jquery.com/)
* [jQuery UI](http://jqueryui.com/)
* [csvexport Yii extension](http://www.yiiframework.com/extension/csvexport)
* [This](http://jquery-howto.blogspot.kr/2009/10/javascript-jquery-password-generator.html) for the password generator

## License

This package is licensed under the BSD License. See the LICENSE file for details.
