# ikdev management system
Click [here](https://ikdev.gitbook.io/ikpanel/) for full documentation.

#### Warning
This package require [Laravel Framework](https://github.com/laravel/laravel).

#### Getting started
Create packages/ikdev folder in your project root and run this command.
``` 
git clone git@github.com:RobyFerro/ikpanel.git
```

* Add the following string into your .env file

``` json
IKPANEL_URL=MY_URL
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

Execute the followings commands:
```
php composer.phar update
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
