<?php

namespace Highwayns\ShopifyAdmin\Traits;

use Highwayns\ShopifyAdmin\Contracts\ShopModel as IShopModel;

/**
 * Allows for setting of a shop and accessing it.
 */
trait ShopAccessible
{
    /**
     * The shop.
     *
     * @var IShopModel
     */
    protected $shop;

    /**
     * Sets the shop.
     *
     * @param IShopModel $shop The shop.
     *
     * @return self
     */
    public function setShop(IShopModel $shop): self
    {
        $this->shop = $shop;
        return $this;
    }
}
