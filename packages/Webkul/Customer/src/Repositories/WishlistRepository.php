<?php

namespace Webkul\Customer\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * Wishlist Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */

class WishlistRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */

    function model()
    {
        return 'Webkul\Customer\Contracts\Wishlist';
    }

    /**
     * @param array $data
     * @return mixed
     */

    public function create(array $data)
    {
        $wishlist = $this->model->create($data);

        return $wishlist;
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */

    public function update(array $data, $id, $attribute = "id")
    {
        $wishlist = $this->find($id);

        $wishlist->update($data);

        return $wishlist;
    }

    /**
     * To retrieve products with wishlist m
     * for a listing resource.
     *
     * @param integer $id
     */
    public function getItemsWithProducts($id) {
        return $this->model->find($id)->item_wishlist;
    }

    /**
     * get customer wishlist Items.
     *
     * @return mixed
     */
    public function getCustomerWhishlist() {
        return $this->model->where([
            'channel_id' => core()->getCurrentChannel()->id,
            'customer_id' => auth()->guard('customer')->user()->id
        ])->paginate(5);
    }
}