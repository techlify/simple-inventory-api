<?php

namespace TechlifyInc\TechlifySimpleInventory;

use Illuminate\Support\Facades\Facade;

/**
 * Description of TechlifySimpleInventoryFacade
 *
 * @author 
 * @since
 */
class TechlifySimpleInventoryFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'laravel-model-logger';
    }

}
