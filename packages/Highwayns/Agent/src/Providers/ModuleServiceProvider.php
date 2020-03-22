<?php

namespace Highwayns\Agent\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Highwayns\Agent\Models\AgentSource::class,
        \Highwayns\Agent\Models\AgentRole::class,
    ];
}