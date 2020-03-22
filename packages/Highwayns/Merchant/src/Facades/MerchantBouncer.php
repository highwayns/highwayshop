<?php

namespace Highwayns\Merchant\Facades;

use Illuminate\Support\Facades\Facade;

class MerchantBouncer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'merchantbouncer';
    }
}