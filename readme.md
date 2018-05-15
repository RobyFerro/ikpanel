# Interactive Knowledge Development
### ikpanel - Web App Generator

Operazioni necessarie all'installazione:

``` 
composer require ikdev/ikpanel
```

* Aggiungere il seguente valore all'interno del file .env

``` json
IKPANEL_URL=MIO_URL
```

* Inserire service provider come da esempio in file config/app.php
```
ikdev\ikpanel\IkpanelServiceProvider::class,
```

* Eseguire comando 
```
php composer.phar update && php composer.phar dump-autoload -o
```