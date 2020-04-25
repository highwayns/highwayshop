<?php

namespace Highwayns\JaPayment\Payment;

use Webkul\Payment\Payment\Payment;

class AuPayment extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'au_payment';

    /**
     * Line items fields mapping
     *
     * @var array
     */
    protected $itemFieldsFormat = [
        'id'       => 'item_number_%d',
        'name'     => 'item_name_%d',
        'quantity' => 'quantity_%d',
        'price'    => 'amount_%d',
    ];

    /**
     * Return paypal redirect url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return route('paypal.standard.redirect');
    }

}