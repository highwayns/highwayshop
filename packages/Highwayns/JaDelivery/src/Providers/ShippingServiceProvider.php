<?php

namespace Highwayns\JaDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class JaDeliveryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //include __DIR__ . '/../Http/helpers.php';
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFacades();

        $this->registerConfig();
    }

    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerFacades()
    {
    }
    
    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
    }
}
