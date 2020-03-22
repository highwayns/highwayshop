<?php

namespace Highwayns\Vendor\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Highwayns\Vendor\Models\VendorSource::class,
        \Highwayns\Vendor\Models\VendorRole::class,
    ];
}