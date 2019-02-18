# Interactive Knowledge Development: ikpanel management system

#### Warning
This package require [Laravel Framework](https://github.com/laravel/laravel).

#### Demo
Click [here](https://demo.ikpanel.eu/) to try ikpanel
* Username: boba.fett@ikpanel.eu
* Password: toor

#### Getting started
Execute the following command:
``` 
composer require "ikdev/ikpanel:dev-master"
```

* Add the following string into your .env file

``` json
IKPANEL_URL=MY_URL
```

* Add the followings service provider in config/app.php 
```
ikdev\ikpanel\IkpanelServiceProvider::class,
Alexusmai\LaravelFileManager\FileManagerServiceProvider::class,
Intervention\Image\ImageServiceProvider::class,
```

* Replace the Model User into config/auth.php like the following example:
```
'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

```
with:
```
'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \ikdev\ikpanel\app\Users::class,
        ],
    ],
```

* Add the following class alias
```
 'Image' => Intervention\Image\Facades\Image::class,
```

Execute the followings commands:
```
php composer.phar update && php composer.phar dump-autoload -o
php artisan vendor:publish --tag=fm-config
php artisan vendor:publish --tag=fm-assets
php artisan vendor:publish --tag=ikpanel
```

Remove default migration from your laravel installation and execute the last command:
```
php artisan migrate
```


## Default users credentials:
* Username : boba.fett@ikpanel.eu
* Password : 0
