<?php

namespace Highwayns\Merchant\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Highwayns\Merchant\Models\MerchantSource::class,
        \Highwayns\Merchant\Models\MerchantRole::class,
    ];
}