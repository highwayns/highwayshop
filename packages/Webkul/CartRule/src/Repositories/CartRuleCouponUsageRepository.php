<?php

namespace Webkul\CartRule\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * CartRuleCouponUsage Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class CartRuleCouponUsageRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\CartRule\Contracts\CartRuleCouponUsage';
    }
}