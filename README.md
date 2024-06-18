# Laravel HTML Minifier

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dipeshsukhia/laravel-html-minify.svg?style=flat-square)](https://packagist.org/packages/dipeshsukhia/laravel-html-minify)
[![Build Status](https://img.shields.io/travis/dipeshsukhia/laravel-html-minify/master.svg?style=flat-square)](https://travis-ci.org/dipeshsukhia/laravel-html-minify)
[![Quality Score](https://img.shields.io/scrutinizer/g/dipeshsukhia/laravel-html-minify.svg?style=flat-square)](https://scrutinizer-ci.com/g/dipeshsukhia/laravel-html-minify)
[![Total Downloads](https://img.shields.io/packagist/dt/dipeshsukhia/laravel-html-minify.svg?style=flat-square)](https://packagist.org/packages/dipeshsukhia/laravel-html-minify)

This package helps to minify your project`s html (blade file) output.

### Requirements

| Laravel    |                   Package |
|------------|--------------------------:|
| 5.x to 9.x |                       2.x |
| \>= 10.x   |                       3.x |

## Installation

You can install the package via composer:

```bash
composer require dipeshsukhia/laravel-html-minify
```

## Sponsor Laravel HTML Minifier on GitHub

[Become a sponsor to Dipesh Sukhia
](https://github.com/sponsors/dipeshsukhia).

## Setup
### Generate Config
``` php
php artisan vendor:publish --tag=LaravelHtmlMinify
```
### add middleware to web middleware group within app/Http/Kernel.php
``` php
\DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml::class
```

## Usage

### for enable in env
``` php
HTML_MINIFY=true
``` 
### for disable in env
``` php
HTML_MINIFY=false
```

### exclude route name for from minify update config
``` php
'exclude_route' => [
        // 'routeName'
]
```
### minify particular html part
``` php
LaravelHtmlMinifyFacade::htmlMinify("<div>...</div>");
```
### exclude minify particular html part
``` php
LaravelHtmlMinifyFacade::excludeHtmlMinify("<div>...</div>");
```
### exclude html minify in blade directory
``` php
@excludeMinify
    <div> exclude code from Minify </div>
@endExcludeMinify
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dipesh.sukhia@gmail.com instead of using the issue tracker.

## Credits

- [Dipesh Sukhia](https://github.com/dipeshsukhia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

