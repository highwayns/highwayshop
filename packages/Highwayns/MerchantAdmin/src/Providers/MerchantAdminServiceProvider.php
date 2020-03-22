<?php

namespace Highwayns\MerchantAdmin\Providers;

use Illuminate\Support\ServiceProvider;
use Highwayns\MerchantAdmin\Providers\EventServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Highwayns\MerchantAdmin\Exceptions\Handler;
use Webkul\Core\Tree;

/**
 * Admin service provider
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class MerchantAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'merchantadmin');

        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/webkul/merchantadmin/assets'),
        ], 'public');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'merchantadmin');

        $this->composeView();

        $this->registerACL();

        $this->app->register(EventServiceProvider::class);

        $this->app->bind(
            ExceptionHandler::class,
            Handler::class
        );
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
     * Bind the the data to the views
     *
     * @return void
     */
    protected function composeView()
    {
        view()->composer(['merchantadmin::layouts.nav-left', 'merchantadmin::layouts.nav-aside', 'merchantadmin::layouts.tabs'], function ($view) {
            $tree = Tree::create();

            $permissionType = auth()->guard('merchantadmin')->user()->role->permission_type;
            $allowedPermissions = auth()->guard('merchantadmin')->user()->role->permissions;

            foreach (config('menu.merchantadmin') as $index => $item) {
                if (! bouncer()->hasPermission($item['key'])) {
                    continue;
                }

                if ($index + 1 < count(config('menu.merchantadmin')) && $permissionType != 'all') {
                    $permission = config('menu.merchantadmin')[$index + 1];

                    if (substr_count($permission['key'], '.') == 2 && substr_count($item['key'], '.') == 1) {
                        foreach ($allowedPermissions as $key => $value) {
                            if ($item['key'] == $value) {
                                $neededItem = $allowedPermissions[$key + 1];

                                foreach (config('menu.merchantadmin') as $key1 => $findMatced) {
                                    if ($findMatced['key'] == $neededItem) {
                                        $item['route'] = $findMatced['route'];
                                    }
                                }
                            }
                        }
                    }
                }

                $tree->add($item, 'menu');
            }

            $tree->items = core()->sortItems($tree->items);

            $view->with('menu', $tree);
        });

        view()->composer(['merchantadmin::users.roles.create', 'merchantadmin::users.roles.edit'], function ($view) {
            $view->with('acl', $this->createACL());
        });
        
        view()->composer(['merchantadmin::catalog.products.create'], function ($view) {
            $items = array();

            foreach (config('product_types') as $item) {
                $item['children'] = [];

                array_push($items, $item);
            }

            $types = core()->sortItems($items);

            $view->with('productTypes', $types);
        });
    }

    /**
     * Registers acl to entire application
     *
     * @return void
     */
    public function registerACL()
    {
        $this->app->singleton('acl', function () {
            return $this->createACL();
        });
    }

    /**
     * Create acl tree
     *
     * @return mixed
     */
    public function createACL()
    {
        static $tree;

        if ($tree)
            return $tree;

        $tree = Tree::create();

        foreach (config('acl') as $item) {
            $tree->add($item, 'acl');
        }

        $tree->items = core()->sortItems($tree->items);

        return $tree;
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php', 'menu.merchantadmin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php', 'acl'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );
    }
}
