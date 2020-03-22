<?php

namespace Webkul\Payment\Payment;

/**
 * Money Transfer payment method class
 *
 * @author    Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class MoneyTransfer extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'moneytransfer';

    public function getRedirectUrl()
    {
        
    }
}