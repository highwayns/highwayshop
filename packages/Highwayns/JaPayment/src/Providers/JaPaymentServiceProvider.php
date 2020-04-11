<?php

namespace Highwayns\JaPament\Providers;

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
    }
}
