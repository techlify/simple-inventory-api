<?php

namespace Techlify\SimpleInventory;

use Illuminate\Support\Facades\Facade;

/**
 * Description of SimpleInventoryFacade
 *
 * @author 
 * @since
 */
class SimpleInventoryFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'simple-inventory';
    }

}
