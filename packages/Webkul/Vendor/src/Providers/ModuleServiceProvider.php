<?php

namespace Webkul\Vendor\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Vendor\Models\VendorSource::class,
        \Webkul\Vendor\Models\VendorRole::class,
    ];
}