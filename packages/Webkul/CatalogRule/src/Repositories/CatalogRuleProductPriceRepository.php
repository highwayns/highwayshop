<?php

namespace Webkul\CatalogRule\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * CatalogRuleProductPrice Repository
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class CatalogRuleProductPriceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\CatalogRule\Contracts\CatalogRuleProductPrice';
    }
}