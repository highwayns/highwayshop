<?php

return [
    [
        'key'  => 'sales',
        'name' => 'admin::app.admin.system.sales',
        'sort' => 1
    ], [
        'key'  => 'sales.paymentmethods',
        'name' => 'admin::app.admin.system.payment-methods',
        'sort' => 2,
    ], [
        'key'    => 'sales.paymentmethods.au_payment',
        'name'   => 'admin::app.admin.system.au_payment',
        'sort'   => 1,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'admin::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'description',
                'title'         => 'admin::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'active',
                'title'         => 'admin::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ],  [
                'name'    => 'sort',
                'title'   => 'admin::app.admin.system.sort_order',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => '1',
                        'value' => 1
                    ], [
                        'title' => '2',
                        'value' => 2
                    ], [
                        'title' => '3',
                        'value' => 3
                    ], [
                        'title' => '4',
                        'value' => 4,
                    ]
                ],
            ]
        ]
    ], [
        'key'    => 'sales.paymentmethods.docomo_payment',
        'name'   => 'admin::app.admin.system.docomo_payment',
        'sort'   => 2,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'admin::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'description',
                'title'         => 'admin::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'active',
                'title'         => 'admin::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ],  [
                'name'    => 'sort',
                'title'   => 'admin::app.admin.system.sort_order',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => '1',
                        'value' => 1,
                    ], [
                        'title' => '2',
                        'value' => 2,
                    ], [
                        'title' => '3',
                        'value' => 3,
                    ], [
                        'title' => '4',
                        'value' => 4,
                    ]
                ],
            ]
        ]
    ], [
        'key'    => 'sales.paymentmethods.softbank_payment',
        'name'   => 'admin::app.admin.system.softbank_payment',
        'sort'   => 3,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'admin::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'          => 'description',
                'title'         => 'admin::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => false,
                'locale_based'  => true,
            ],  [
                'name'       => 'business_account',
                'title'      => 'admin::app.admin.system.business-account',
                'type'       => 'select',
                'type'       => 'text',
                'validation' => 'required',
            ],  [
                'name'          => 'active',
                'title'         => 'admin::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true
            ], [
                'name'          => 'sandbox',
                'title'         => 'admin::app.admin.system.sandbox',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => false,
                'locale_based'  => true,
            ], [
                'name'    => 'sort',
                'title'   => 'admin::app.admin.system.sort_order',
                'type'    => 'select',
                'options' => [
                    [
                        'title' => '1',
                        'value' => 1,
                    ], [
                        'title' => '2',
                        'value' => 2,
                    ], [
                        'title' => '3',
                        'value' => 3,
                    ], [
                        'title' => '4',
                        'value' => 4,
                    ],
                ],
            ]
        ]
    ]
];