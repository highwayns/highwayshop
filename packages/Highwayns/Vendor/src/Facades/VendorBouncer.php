<?php

namespace Highwayns\Vendor\Facades;

use Illuminate\Support\Facades\Facade;

class VendorBouncer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vendorbouncer';
    }
}