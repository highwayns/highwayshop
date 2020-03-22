<?php

namespace Highwayns\Merchant\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Merchant Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class MerchantSourceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Highwayns\Merchant\Contracts\MerchantSource';
    }
}