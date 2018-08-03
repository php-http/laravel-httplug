# Laravel-Httplug

[![Latest Version](https://img.shields.io/github/release/php-http/laravel-httplug.svg?style=flat-square)](https://github.com/php-http/laravel-httplug/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/php-http/laravel-httplug.svg?style=flat-square)](https://travis-ci.org/php-http/laravel-httplug)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/php-http/laravel-httplug.svg?style=flat-square)](https://scrutinizer-ci.com/g/php-http/laravel-httplug)
[![Quality Score](https://img.shields.io/scrutinizer/g/php-http/laravel-httplug.svg?style=flat-square)](https://scrutinizer-ci.com/g/php-http/laravel-httplug)
[![Total Downloads](https://img.shields.io/packagist/dt/php-http/laravel-httplug.svg?style=flat-square)](https://packagist.org/packages/php-http/laravel-httplug)

## Install

Via Composer

``` bash
$ composer require php-http/laravel-httplug
```

With Laravel 5.5 or newer, the package will be discovered automatically.
If you're using an older version of Laravel, add the following to your
`config/app.php`:

```php
<?php
// config.app

'providers' => [
    ...,
    ...,

     Http\Httplug\HttplugServiceProvider::class,

],

'aliases' => [
    ...,
    ...,

    'Httplug'   => Http\Httplug\Facade\Httplug::class,

],


```

Publish the package config file to `config/httplug.php`:

```
php artisan vendor:publish --provider="Http\Httplug\HttplugServiceProvider"
```

## Usage

```php
<?php

// Create a request using a MessageFactory
$factory = app()->make('httplug.message_factory.default');
$request = $factory->createRequest('GET', 'http://httpbin.org');

$httplug = app()->make('httplug');

// Send request with default driver
$response = $httplug->sendRequest($request);

// Send request with another driver
$response = $httplug->driver('curl')->sendRequest($request);

// Send request with default driver using facade
$response = Httplug::sendRequest($request);

// Send request with another driver using facade
$response = Httplug::driver('curl')->sendRequest($request)

```

## Testing

``` bash
$ composer test
```

## Contributing

Please see our [contributing guide](http://docs.php-http.org/en/latest/development/contributing.html).

## Security

If you discover any security related issues, please contact us at [security@php-http.org](mailto:security@php-http.org).


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
