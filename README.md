# Adds a zero configuration Admin Panel to your Laravel Application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/the42coders/the-laravel-admin-panel.svg?style=flat-square)](https://packagist.org/packages/the42coders/the-laravel-admin-panel)
[![Build Status](https://img.shields.io/travis/the42coders/the-laravel-admin-panel/master.svg?style=flat-square)](https://travis-ci.org/the42coders/the-laravel-admin-panel)
[![Quality Score](https://img.shields.io/scrutinizer/g/the42coders/the-laravel-admin-panel.svg?style=flat-square)](https://scrutinizer-ci.com/g/the42coders/the-laravel-admin-panel)
[![Total Downloads](https://img.shields.io/packagist/dt/the42coders/the-laravel-admin-panel.svg?style=flat-square)](https://packagist.org/packages/the42coders/the-laravel-admin-panel)

## Installation

You can install the package via composer:

```bash
composer require the42coders/the-laravel-admin-panel
```

You need to register the routes to your web.php routes File as well. Since the-laravel-admin-panel Package is very powerful make sure to secure the routes with whatever authentication you use in the rest of your app.

```php
Route::group(['middleware' => ['auth']], function () {
    \the42coders\TLAP\TLAP::routes();
});
```

You need to publish the assets of the Package

```bash
php artisan vendor:publish --provider="the42coders\TLAP\TLAPServiceProvider"  --tag=assets  
```

Other publishable Contents are

config

```bash
php artisan vendor:publish --provider="the42coders\TLAP\TLAPServiceProvider"  --tag=config  
```

language

```bash
php artisan vendor:publish --provider="the42coders\TLAP\TLAPServiceProvider"  --tag=lang  
```

views

```bash
php artisan vendor:publish --provider="the42coders\TLAP\TLAPServiceProvider"  --tag=views  
```


## Usage

To generate the CRUD for a Model just add the TLAPAdminTrait to your Model.

``` php
use the42coders\TLAP\Traits\TLAPAdminTrait;

class User extends Model
{
    use TLAPAdminTrait;
```

and register it in the config tlap.php.

``` php
'models' => [
    'users' => 'App\Models\User',
]
```

Now you can just visit the url of https://your-website.de/admin.
You can change the url under which the admin panel will be accessible 
in the tlap.php config file with the path variable.

This package autoload your relations if you use return types on them.

``` php
public function posts(): HasMany
{
    return $this->hasMany('App\Models\Post');
}
```

The package is guessing your application by its Database structure. 
Including validation. But you can overwrite this guessing by your own wishes.

You only need to add the static function fields to your Model and set the 
$fields array with your Field definitions. This is the area which might change
a little before the final release.

``` php
public static function fields()
{
    self::$fields = [
        new TextField('name', 'Name'),
        new TextField('slug', 'Slug'),
        new TextField('description', 'Description', false),
        new TextField('menu', 'Menu'),
        new TextField('image', 'Image'),
        new TextField('parent_id', 'Parent ID'),
    ];

    return self::$fields;
}
```

By now we have the following Fields out of the box. 

Field | Description
---- | -----------
Checkbox | Default bs5 Checkbox
File | Default bs5 Filepicker
Select | Default bs5 Select field
Text | Default bs5 text input field
TextField | Default bs5 Textarea.

In the future it will be possible to add your own Fields as well.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email max@42coders.com instead of using the issue tracker.

## Credits

- [Max Hutschenreiter](https://github.com/max-hutschenreiter)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
