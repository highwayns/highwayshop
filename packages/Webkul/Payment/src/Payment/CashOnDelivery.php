<?php

namespace Webkul\Payment\Payment;

/**
 * Cash On Delivery payment method class
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class CashOnDelivery extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'cashondelivery';

    public function getRedirectUrl()
    {
        
    }
}