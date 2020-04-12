<?php

return [
    [
        'key' => 'merchant_sources',
        'name' => 'merchantadmin::app.acl.merchant-sources',
        'route' => 'admin.merchant_sources.index',
        'sort' => 10
    ], [
        'key' => 'merchant_sources.merchant_sources',
        'name' => 'merchantadmin::app.layouts.merchant-sources',
        'route' => 'admin.merchant_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'merchant_sources.create',
        'name' => 'merchantadmin::app.acl.create',
        'route' => 'admin.merchant_sources.create',
        'sort' => 1
    ], [
        'key' => 'merchant_sources.edit',
        'name' => 'merchantadmin::app.acl.edit',
        'route' => 'admin.merchant_sources.edit',
        'sort' => 2
    ], [
        'key' => 'merchant_sources.delete',
        'name' => 'merchantadmin::app.acl.delete',
        'route' => 'admin.merchant_sources.delete',
        'sort' => 3
    ], [
        'key' => 'merchant_sources.roles',
        'name' => 'merchantadmin::app.acl.roles',
        'route' => 'admin.merchantroles.index',
        'sort' => 2
    ], [
        'key' => 'merchant_sources.roles.create',
        'name' => 'merchantadmin::app.acl.create',
        'route' => 'admin.merchantroles.create',
        'sort' => 1
    ], [
        'key' => 'merchant_sources.roles.edit',
        'name' => 'merchantadmin::app.acl.edit',
        'route' => 'admin.merchantroles.edit',
        'sort' => 2
    ], [
        'key' => 'merchant_sources.roles.delete',
        'name' => 'merchantadmin::app.acl.delete',
        'route' => 'admin.merchantroles.delete',
        'sort' => 3
    ],
];

?>