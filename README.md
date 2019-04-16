# LaravelModelLogger

A simple package for Laravel that provides model event logging services

## Installation

Install this package with composer using the following command:

```
composer require techlify-inc/laravel-model-logger
```

Run migrations

```
$ php artisan migrate
```

## Usage

Just add the following trait to models that needs logging: 


```php
use TechlifyInc\LaravelModelLogger\Traits\LoggableModel;
```


### Configuring which events to Log

To disable logging for certain events, in your model, you can do: 

```php

protected $logCreated = false;
protected $logUpdated = false;
protected $logDeleted = false;

```