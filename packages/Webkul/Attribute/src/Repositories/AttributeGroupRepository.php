<?php

namespace Webkul\Attribute\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Attribute Group Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class AttributeGroupRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Attribute\Contracts\AttributeGroup';
    }
}