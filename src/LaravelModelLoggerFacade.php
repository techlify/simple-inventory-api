<?php

namespace TechlifyInc\LaravelModelLogger;

use Illuminate\Support\Facades\Facade;

/**
 * Description of LaravelModelLoggerFacade
 *
 * @author 
 * @since
 */
class LaravelModelLoggerFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'laravel-model-logger';
    }

}
