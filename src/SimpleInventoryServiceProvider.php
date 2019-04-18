<?php

namespace Techlify\SimpleInventory;

use Illuminate\Support\ServiceProvider;

/**
 * Description of SimpleInventoryServiceProvider
 *
 * @author 
 */
class SimpleInventoryServiceProvider extends ServiceProvider
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
        $this->app->singleton(SimpleInventory::class, function ()
        {
            return new SimpleInventory();
        });

        $this->app->alias(SimpleInventory::class, 'simple-inventory');
    }

}
