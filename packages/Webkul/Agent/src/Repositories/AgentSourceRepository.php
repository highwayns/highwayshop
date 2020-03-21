<?php

namespace Webkul\Agent\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Agent Reposotory
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class AgentSourceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Agent\Contracts\AgentSource';
    }
}