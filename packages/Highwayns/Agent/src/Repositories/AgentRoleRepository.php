<?php

namespace Highwayns\Agent\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Role Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class AgentRoleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Highwayns\Agent\Contracts\AgentRole';
    }
}