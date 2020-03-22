<?php

namespace Highwayns\Vendor\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Vendor Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class VendorSourceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Highwayns\Vendor\Contracts\VendorSource';
    }
}