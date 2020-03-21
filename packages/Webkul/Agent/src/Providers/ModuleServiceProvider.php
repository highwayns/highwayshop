<?php

namespace Webkul\Agent\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Agent\Models\AgentSource::class,
        \Webkul\Agent\Models\AgentRole::class,
    ];
}