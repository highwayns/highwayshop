<?php

namespace Highwayns\Agent\Facades;

use Illuminate\Support\Facades\Facade;

class AgentBouncer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'agentbouncer';
    }
}