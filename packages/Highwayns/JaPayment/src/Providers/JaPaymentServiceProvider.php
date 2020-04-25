<?php

namespace Highwayns\JaPayment\Providers;

use Illuminate\Support\ServiceProvider;

class JaPaymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/routes.php';

        // include __DIR__ . '/../Http/helpers.php';
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/paymentmethods.php', 'paymentmethods'
        );

        // $this->mergeConfigFrom(
        //    dirname(__DIR__) . '/Config/system.php', 'core'
        // );
    }

}
