<?php

return [
    [
        'key' => 'settings.merchant_sources',
        'name' => 'admin::app.acl.merchant-sources',
        'route' => 'admin.merchant_sources.index',
        'sort' => 10
    ], [
        'key' => 'settings.merchant_sources.merchant_sources',
        'name' => 'admin::app.layouts.merchant-sources',
        'route' => 'admin.merchant_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.merchant_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'admin.merchant_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.merchant_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'admin.merchant_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.merchant_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'admin.merchant_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.merchant_sources.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'admin.merchantroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.merchant_sources.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'admin.merchantroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.merchant_sources.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'admin.merchantroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.merchant_sources.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'admin.merchantroles.delete',
        'sort' => 3
    ],
];

?>