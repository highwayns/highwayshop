<?php
return [
    'au_payment'  => [
        'code'        => 'au_payment',
        'title'       => 'AuPayment',
        'description' => 'AuPayment',
        'class'       => 'Highwayns\JaPayment\Payment\AuPayment',
        'active'      => true,
        'sort'        => 4,
    ],

    'docomo_payment'   => [
        'code'        => 'docomo_payment',
        'title'       => 'DocomoPayment',
        'description' => 'DocomoPayment',
        'class'       => 'Highwayns\JaPayment\Payment\DocomoPayment',
        'active'      => true,
        'sort'        => 5,
    ],

    'softbank_payment' => [
        'code'             => 'softbank_payment',
        'title'            => 'SoftbankPayment',
        'description'      => 'SoftbankPayment',
        'class'            => 'Highwayns\JaPayment\Payment\SoftbankPayment',
        'sandbox'          => true,
        'active'           => true,
        // 'business_account' => 'test@webkul.com',
        'sort'             => 6,
    ]
];