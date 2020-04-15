<?php

return [
    'layouts' => [
        'merchantroles' => 'merchantroles',        
        'merchant-sources' => 'merchant-sources'
    ],

    'acl' => [
        'merchant-sources' => 'merchant-sources'
    ],

    'datagrid' => [
        'merchant-source' => 'merchant-source',
    ],

    'sales' => [

        'shipments' => [
            'merchant-source' => 'merchant-source'
        ]
    ],

    'settings' => [
        'merchant_sources' => [
            'title' => 'title',
            'add-title' => 'add-title',
            'edit-title' => 'edit-title',
            'save-btn-title' => 'save-btn-title',
            'general' => 'general',
            'id' =>'ID',
            'email' => 'email',
            'name' => 'name',
            'password' => 'password',
            'confirm-password' => 'confirm-password',
            'status-and-role' => 'status-and-role',
            'role' => 'role',
            'status' => 'status',
            'account-is-active' => 'account-is-active',
            'vendor_id' => 'vendor_id',
            'agency_group_id' => 'agency_group_id',
            'postal_code' => 'postal_code',
            'pref' => 'pref',
            'city' => 'city',
            'address' => 'address',
            'building_name' => 'building_name',
            'tel' => 'tel',
            'fax' => 'fax',
            'agency_denki_shop_code' => 'agency_denki_shop_code',
            'created_at' => 'created_at',
            'created_user_id' => 'created_user_id',
            'updated_at' => 'updated_at',
            'updated_user_id' => 'updated_user_id',
            'create-success' => 'create-success.',
            'update-success' => 'update-success.',
            'delete-success' => 'delete-success.',
            'last-delete-error' => 'last-delete-error.',
        ]
    ],

    'admin' => [
        'system' => [
            'merchant' => 'merchant',
        ]
    ]
];
