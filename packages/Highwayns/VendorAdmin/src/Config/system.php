<?php

return [
    [
        'key' => 'general',
        'name' => 'vendoradmin::app.admin.system.general',
        'sort' => 1,
    ], [
        'key' => 'general.general',
        'name' => 'vendoradmin::app.admin.system.general',
        'sort' => 1,
    ], [
        'key' => 'general.general.locale_options',
        'name' => 'vendoradmin::app.admin.system.locale-options',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'weight_unit',
                'title' => 'admin::app.admin.system.weight-unit',
                'type' => 'select',
                'options' => [
                    [
                        'title' => 'lbs',
                        'value' => 'lbs'
                    ], [
                        'title' => 'kgs',
                        'value' => 'kgs'
                    ]
                ],
                'channel_based' => true,
            ]
        ]
    ], [
        'key' => 'general.content',
        'name' => 'vendoradmin::app.admin.system.content',
        'sort' => 2,
    ], [
        'key' => 'general.content.footer',
        'name' => 'vendoradmin::app.admin.system.footer',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'footer_content',
                'title' => 'admin::app.admin.system.footer-content',
                'type' => 'text',
                'channel_based' => true,
                'locale_based' => true
            ], [
                'name' => 'footer_toggle',
                'title' => 'admin::app.admin.system.footer-toggle',
                'type' => 'select',
                'options' => [
                    [
                        'title' => 'True',
                        'value' => 1
                    ], [
                        'title' => 'False',
                        'value' => 0
                    ]
                ],
                'locale_based' => true,
                'channel_based' => true,
            ]
        ]
    ], [
        'key' => 'general.design',
        'name' => 'vendoradmin::app.admin.system.design',
        'sort' => 3,
    ], [
        'key' => 'general.design.admin_logo',
        'name' => 'vendoradmin::app.admin.system.admin-logo',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'logo_image',
                'title' => 'admin::app.admin.system.logo-image',
                'type' => 'image',
                'channel_based' => true,
            ]
        ]
    ], [
        'key' => 'catalog',
        'name' => 'vendoradmin::app.admin.system.catalog',
        'sort' => 2
    ], [
        'key' => 'catalog.products',
        'name' => 'vendoradmin::app.admin.system.products',
        'sort' => 2
    ], [
        'key' => 'catalog.products.review',
        'name' => 'vendoradmin::app.admin.system.review',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'guest_review',
                'title' => 'admin::app.admin.system.allow-guest-review',
                'type' => 'boolean'
            ]
        ]
    ], [
        'key' => 'catalog.inventory',
        'name' => 'vendoradmin::app.admin.system.inventory',
        'sort' => 1,
    ], [
        'key' => 'catalog.inventory.stock_options',
        'name' => 'vendoradmin::app.admin.system.stock-options',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'backorders',
                'title' => 'admin::app.admin.system.allow-backorders',
                'type' => 'boolean',
                'channel_based' => true
            ]
        ]
    ], [
        'key' => 'customer',
        'name' => 'vendoradmin::app.admin.system.customer',
        'sort' => 3,
    ], [
        'key' => 'customer.settings',
        'name' => 'vendoradmin::app.admin.system.settings',
        'sort' => 1,
    ], [
        'key' => 'customer.settings.address',
        'name' => 'vendoradmin::app.admin.system.address',
        'sort' => 1,
        'fields' => [
            [
                'name' => 'street_lines',
                'title' => 'admin::app.admin.system.street-lines',
                'type' => 'text',
                'validation' => 'between:1,4',
                'channel_based' => true
            ]
        ]
    ], [
        'key' => 'customer.settings.newsletter',
        'name' => 'vendoradmin::app.admin.system.newsletter',
        'sort' => 2,
        'fields' => [
            [
                'name' => 'subscription',
                'title' => 'admin::app.admin.system.newsletter-subscription',
                'type' => 'boolean',
            ]
        ],
    ], [
        'key' => 'customer.settings.email',
        'name' => 'vendoradmin::app.admin.system.email',
        'sort' => 3,
        'fields' => [
            [
                'name' => 'verification',
                'title' => 'admin::app.admin.system.email-verification',
                'type' => 'boolean'
            ]
        ],
    ], 
];