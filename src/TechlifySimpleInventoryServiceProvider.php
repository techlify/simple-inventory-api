<?php

namespace TechlifyInc\TechlifySimpleInventory;

use Illuminate\Support\ServiceProvider;

/**
 * Description of TechlifySimpleInventoryServiceProvider
 *
 * @author 
 */
class TechlifySimpleInventoryServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TechlifySimpleInventory::class, function ()
        {
            return new TechlifySimpleInventory();
        });

        $this->app->alias(TechlifySimpleInventory::class, 'techlify-simple-inventory');
    }

}
