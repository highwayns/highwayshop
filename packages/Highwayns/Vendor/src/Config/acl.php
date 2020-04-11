<?php

return [
    [
        'key' => 'settings.vendor_sources',
        'name' => 'admin::app.acl.vendor-sources',
        'route' => 'admin.vendor_sources.index',
        'sort' => 9
    ], [
        'key' => 'settings.vendor_sources.vendor_sources',
        'name' => 'admin::app.layouts.vendor-sources',
        'route' => 'admin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'admin.vendor_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'admin.vendor_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'admin.vendor_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.vendor_sources.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'admin.vendorroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'admin.vendorroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'admin.vendorroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'admin.vendorroles.delete',
        'sort' => 3
    ],
];

?>