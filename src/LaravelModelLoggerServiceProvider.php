<?php

namespace TechlifyInc\LaravelModelLogger;

use Illuminate\Support\ServiceProvider;

/**
 * Description of LaravelModelLoggerServiceProvider
 *
 * @author 
 */
class LaravelModelLoggerServiceProvider extends ServiceProvider
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
        $this->app->singleton(LaravelModelLogger::class, function ()
        {
            return new LaravelModelLogger();
        });

        $this->app->alias(LaravelModelLogger::class, 'laravel-model-logger');
    }

}
