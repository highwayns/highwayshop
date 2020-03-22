<?php

namespace Webkul\Product\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;

/**
 * Product Review Reposotory
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class ProductReviewRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Product\Contracts\ProductReview';
    }

    /**
     * Retrieve review for customerId
     *
     * @param int $customerId
     */
    function getCustomerReview()
    {
        $customerId = auth()->guard('customer')->user()->id;

        $reviews = $this->model->where(['customer_id'=> $customerId])->with('product')->paginate(5);

        return $reviews;
    }
}