<?php

namespace Webkul\Core\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Currency Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class CurrencyRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Contracts\Currency';
    }

    public function delete($id) {
        if ($this->model->count() == 1) {
            return false;
        } else {
            if ($this->model->destroy($id)) {
                return true;
            } else {
                return false;
            }

        }
    }
}