<?php

namespace Webkul\CartRule\Listeners;

use Webkul\CartRule\Helpers\CartRule;

/**
 * Cart event handler
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class Cart
{
    /**
     * CartRule object
     *
     * @var CartRule
     */
    protected $cartRuleHepler;

    /**
     * Create a new listener instance.
     *
     * @param  Webkul\CartRule\Repositories\CartRule $cartRuleHepler
     * @return void
     */
    public function __construct(CartRule $cartRuleHepler)
    {
        $this->cartRuleHepler = $cartRuleHepler;
    }

    /**
     * Aplly valid cart rules to cart
     * 
     * @param Cart $cart
     * @return void
     */
    public function applyCartRules($cart)
    {
        $this->cartRuleHepler->collect();
    }
}