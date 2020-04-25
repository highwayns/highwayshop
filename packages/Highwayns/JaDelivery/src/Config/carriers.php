<?php

return [
    'sagawa' => [
        'code'         => 'sagawa',
        'title'        => '佐川急便',
        'description'  => '佐川急便',
        'active'       => true,
        'default_rate' => '10',
        'type'         => 'per_unit',
        'class'        => 'Highwayns\JaDelivery\Carriers\Sagawa',
    ],

    'yamato'     => [
        'code'         => 'yamato',
        'title'        => 'ヤマト運輸',
        'description'  => 'ヤマト運輸',
        'active'       => true,
        'default_rate' => '10',
        'type'         => 'per_unit',
        'class'        => 'Highwayns\JaDelivery\Carriers\Yamato',
    ]
];