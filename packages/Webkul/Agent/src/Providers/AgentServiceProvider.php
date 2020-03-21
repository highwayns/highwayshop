<?php

namespace Webkul\Agent\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Webkul\Agent\AgentBouncer;
use Webkul\Agent\Facades\AgentBouncer as BouncerFacade;
use Webkul\Agent\Http\Middleware\AgentBouncer as BouncerMiddleware;

class AgentServiceProvider extends ServiceProvider
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
        $loader->alias('AgentBouncer', BouncerFacade::class);

        $this->app->singleton('agentbouncer', function () {
            return new AgentBouncer();
        });
    }
}
