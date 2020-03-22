<?php

namespace Webkul\User\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Role Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class RoleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\User\Contracts\Role';
    }
}