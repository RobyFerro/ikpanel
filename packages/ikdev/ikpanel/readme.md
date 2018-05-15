# Interactive Knowledge Development
### ikpanel - Web App Generator

Operazioni necessarie all'installazione:
* Inserire la cartella ikdev all'interno della directory "packages".
* Modificare file composer.json con il seguente codice.

``` json
autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/",
            "Ikdev\\Ikpanel\\": "packages/ikdev/ikpanel/src"
        }
    },
```

* Aggiungere il seguente valore all'interno del file .env

``` json
IKPANEL_URL=MIO_URL
```

* Inserire service provider come da esempio in file config/app.php
```
Ikdev\Ikpanel\IkpanelServiceProvider::class,
```

* Eseguire comando 
```
php composer.phar update && php composer.phar dump-autoload -o
```