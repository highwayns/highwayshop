<?php

namespace Webkul\CatalogRule\Listeners;

use Webkul\CatalogRule\Helpers\CatalogRuleIndex;

/**
 * Products Event handler
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class Product
{
    /**
     * Product Repository Object
     * 
     * @var Object
     */
    protected $catalogRuleIndexHelper;

    /**
     * Create a new listener instance.
     * 
     * @param  Webkul\CatalogRule\Helpers\CatalogRuleIndex $catalogRuleIndexHelper
     * @return void
     */
    public function __construct(CatalogRuleIndex $catalogRuleIndexHelper)
    {
        $this->catalogRuleIndexHelper = $catalogRuleIndexHelper;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function createProductRuleIndex($product)
    {
        $this->catalogRuleIndexHelper->reindexProduct($product);
    }
}