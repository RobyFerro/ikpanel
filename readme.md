# Interactive Knowledge Development
### ikpanel - Web App Generator

Operazioni necessarie all'installazione:

``` 
composer require ikdev/ikpanel
```

* Aggiungere il seguente valore all'interno del file .env

``` json
IKPANEL_URL=MY_URL
```

* Inserire service provider come da esempio in file config/app.php
```
ikdev\ikpanel\IkpanelServiceProvider::class,
Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider::class,
Intervention\Image\ImageServiceProvider::class,
```

* E aggiungi la classe alias
```
 'Image' => Intervention\Image\Facades\Image::class,
```

* Eseguire comandi
```
php composer.phar update && php composer.phar dump-autoload -o
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
php artisan vendor:publish --tag=ikpanel
```