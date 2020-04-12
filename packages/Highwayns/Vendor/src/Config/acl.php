<?php

return [
    [
        'key' => 'vendor_sources',
        'name' => 'vendoradmin::app.acl.vendor-sources',
        'route' => 'admin.vendor_sources.index',
        'sort' => 9
    ], [
        'key' => 'vendor_sources.vendor_sources',
        'name' => 'vendoradmin::app.layouts.vendor-sources',
        'route' => 'admin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'vendor_sources.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'admin.vendor_sources.create',
        'sort' => 1
    ], [
        'key' => 'vendor_sources.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'admin.vendor_sources.edit',
        'sort' => 2
    ], [
        'key' => 'vendor_sources.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'admin.vendor_sources.delete',
        'sort' => 3
    ], [
        'key' => 'vendor_sources.roles',
        'name' => 'vendoradmin::app.acl.roles',
        'route' => 'admin.vendorroles.index',
        'sort' => 2
    ], [
        'key' => 'vendor_sources.roles.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'admin.vendorroles.create',
        'sort' => 1
    ], [
        'key' => 'vendor_sources.roles.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'admin.vendorroles.edit',
        'sort' => 2
    ], [
        'key' => 'vendor_sources.roles.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'admin.vendorroles.delete',
        'sort' => 3
    ],
];

?>