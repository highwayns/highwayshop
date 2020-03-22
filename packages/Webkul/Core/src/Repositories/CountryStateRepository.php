<?php

namespace Webkul\Core\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * CountryState Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class CountryStateRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Contracts\CountryState';
    }
}