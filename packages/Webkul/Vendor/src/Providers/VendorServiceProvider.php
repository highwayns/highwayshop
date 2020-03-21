<?php

namespace Webkul\Vendor\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Webkul\Vendor\VendorBouncer;
use Webkul\Vendor\Facades\VendorBouncer as BouncerFacade;
use Webkul\Vendor\Http\Middleware\VendorBouncer as BouncerMiddleware;

class VendorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        include __DIR__ . '/../Http/helpers.php';

        $router->aliasMiddleware('vendoradmin', BouncerMiddleware::class);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBouncer();
    }

    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerBouncer()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('VendorBouncer', BouncerFacade::class);

        $this->app->singleton('vendorbouncer', function () {
            return new VendorBouncer();
        });
    }
}
