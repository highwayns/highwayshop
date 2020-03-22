<?php

namespace Webkul\CartRule\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * CartRuleCustomer Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class CartRuleCustomerRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\CartRule\Contracts\CartRuleCustomer';
    }
}