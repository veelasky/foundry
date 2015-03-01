### Laravel Auth: Extended
----

**Laravel Auth: Extended** is an extended version of the original Laravel Authentication package.

#### Installation

To use this package simply, register the service provider into the list of provider on your `config\app.php` file.

```php
    
    'providers' => [
        ...
        'Veelasky\Foundry\Auth\ServiceProvider'
        ...
    ],
```

and to activate the extended driver set the driver in your `config\auth.php` to `foundry` and then you're done.