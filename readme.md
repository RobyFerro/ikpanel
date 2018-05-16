# Interactive Knowledge Development: @ikpanel - Web App Generator

[![Latest Stable Version](https://poser.pugx.org/ikdev/ikpanel/v/stable)](https://packagist.org/packages/ikdev/ikpanel)
[![Total Downloads](https://poser.pugx.org/ikdev/ikpanel/downloads)](https://packagist.org/packages/ikdev/ikpanel)
[![Latest Unstable Version](https://poser.pugx.org/ikdev/ikpanel/v/unstable)](https://packagist.org/packages/ikdev/ikpanel)
[![License](https://poser.pugx.org/ikdev/ikpanel/license)](https://packagist.org/packages/ikdev/ikpanel)

##### Warning
This package require Laravel Framework. You can install it through the following command.
``` 
composer require laravel/laravel
```

#### Getting started

Execute the following command:
``` 
composer require ikdev/ikpanel
```

* Add the following string into your .env file

``` json
IKPANEL_URL=MY_URL
```

* Add the followings service provider in config/app.php 
```
ikdev\ikpanel\IkpanelServiceProvider::class,
Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider::class,
Intervention\Image\ImageServiceProvider::class,
```

* Add the following class alias
```
 'Image' => Intervention\Image\Facades\Image::class,
```

Execute the followings commands:
```
php composer.phar update && php composer.phar dump-autoload -o
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
php artisan vendor:publish --tag=ikpanel
```

## Default users credentials:
* Username : boba.fett@demo.com
* Password : toor

## v1.0 progress

- [x] Administration panel
- [x] Integrate Laravel Filemanager
- [ ] Traslate Laravel Filemanager
- [ ] Remplace template HTML (ElaAdmin)
- [ ] Enable/disable module
- [ ] Blog module