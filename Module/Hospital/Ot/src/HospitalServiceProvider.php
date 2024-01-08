<?php

namespace Hospital\Ot;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
class HospitalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        // Register a singleton to provide the authenticated user to the package
     
        $this->app->make('Hospital\Ot\HospitalController');
        $this->loadViewsFrom(__DIR__.'/views','Ot');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

      $this->app->singleton(Authenticatable::class, function ($app) {
       return $app['auth']->user();
    });

    
      include __DIR__.'/routes.php';
    }
}
