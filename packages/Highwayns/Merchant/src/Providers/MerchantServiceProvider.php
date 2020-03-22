<?php

namespace Highwayns\Merchant\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Highwayns\Merchant\MerchantBouncer;
use Highwayns\Merchant\Facades\MerchantBouncer as BouncerFacade;
use Highwayns\Merchant\Http\Middleware\MerchantBouncer as BouncerMiddleware;

class MerchantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        include __DIR__ . '/../Http/helpers.php';

        $router->aliasMiddleware('agentadmin', BouncerMiddleware::class);

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
        $loader->alias('MerchantBouncer', BouncerFacade::class);

        $this->app->singleton('agentbouncer', function () {
            return new MerchantBouncer();
        });
    }
}
