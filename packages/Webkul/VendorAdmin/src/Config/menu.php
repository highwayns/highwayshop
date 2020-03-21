<?php

return [
    [
        'key' => 'dashboard',
        'name' => 'vendoradmin::app.layouts.dashboard',
        'route' => 'vendoradmin.dashboard.index',
        'sort' => 1,
        'icon-class' => 'dashboard-icon'
    ], [
        'key' => 'sales',
        'name' => 'vendoradmin::app.layouts.sales',
        'route' => 'vendoradmin.sales.orders.index',
        'sort' => 2,
        'icon-class' => 'sales-icon'
    ], [
        'key' => 'sales.orders',
        'name' => 'vendoradmin::app.layouts.orders',
        'route' => 'vendoradmin.sales.orders.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'sales.shipments',
        'name' => 'vendoradmin::app.layouts.shipments',
        'route' => 'vendoradmin.sales.shipments.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'sales.invoices',
        'name' => 'vendoradmin::app.layouts.invoices',
        'route' => 'vendoradmin.sales.invoices.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'sales.refunds',
        'name' => 'vendoradmin::app.layouts.refunds',
        'route' => 'vendoradmin.sales.refunds.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'catalog',
        'name' => 'vendoradmin::app.layouts.catalog',
        'route' => 'vendoradmin.catalog.products.index',
        'sort' => 3,
        'icon-class' => 'catalog-icon'
    ], [
        'key' => 'catalog.products',
        'name' => 'vendoradmin::app.layouts.products',
        'route' => 'vendoradmin.catalog.products.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'catalog.categories',
        'name' => 'vendoradmin::app.layouts.categories',
        'route' => 'vendoradmin.catalog.categories.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'catalog.attributes',
        'name' => 'vendoradmin::app.layouts.attributes',
        'route' => 'vendoradmin.catalog.attributes.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'catalog.families',
        'name' => 'vendoradmin::app.layouts.attribute-families',
        'route' => 'vendoradmin.catalog.families.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'customers',
        'name' => 'vendoradmin::app.layouts.customers',
        'route' => 'vendoradmin.customer.index',
        'sort' => 4,
        'icon-class' => 'customer-icon'
    ], [
        'key' => 'customers.customers',
        'name' => 'vendoradmin::app.layouts.customers',
        'route' => 'vendoradmin.customer.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'customers.groups',
        'name' => 'vendoradmin::app.layouts.groups',
        'route' => 'vendoradmin.groups.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'customers.reviews',
        'name' => 'vendoradmin::app.layouts.reviews',
        'route' => 'vendoradmin.customer.review.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'customers.subscribers',
        'name' => 'vendoradmin::app.layouts.newsletter-subscriptions',
        'route' => 'vendoradmin.customers.subscribers.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'configuration',
        'name' => 'vendoradmin::app.layouts.configure',
        'route' => 'vendoradmin.configuration.index',
        'sort' => 7,
        'icon-class' => 'configuration-icon'
    ], [
        'key' => 'settings',
        'name' => 'vendoradmin::app.layouts.settings',
        'route' => 'vendoradmin.locales.index',
        'sort' => 6,
        'icon-class' => 'settings-icon'
    ], [
        'key' => 'settings.locales',
        'name' => 'vendoradmin::app.layouts.locales',
        'route' => 'vendoradmin.locales.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.currencies',
        'name' => 'vendoradmin::app.layouts.currencies',
        'route' => 'vendoradmin.currencies.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.exchange_rates',
        'name' => 'vendoradmin::app.layouts.exchange-rates',
        'route' => 'vendoradmin.exchange_rates.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'settings.inventory_sources',
        'name' => 'vendoradmin::app.layouts.inventory-sources',
        'route' => 'vendoradmin.inventory_sources.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'settings.channels',
        'name' => 'vendoradmin::app.layouts.channels',
        'route' => 'vendoradmin.channels.index',
        'sort' => 5,
        'icon-class' => ''
    ], [
        'key' => 'settings.users',
        'name' => 'vendoradmin::app.layouts.users',
        'route' => 'vendoradmin.users.index',
        'sort' => 6,
        'icon-class' => ''
    ], [
        'key' => 'settings.users.users',
        'name' => 'vendoradmin::app.layouts.users',
        'route' => 'vendoradmin.users.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.users.roles',
        'name' => 'vendoradmin::app.layouts.roles',
        'route' => 'vendoradmin.roles.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.sliders',
        'name' => 'vendoradmin::app.layouts.sliders',
        'route' => 'vendoradmin.sliders.index',
        'sort' => 7,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes',
        'name' => 'vendoradmin::app.layouts.taxes',
        'route' => 'vendoradmin.tax-categories.index',
        'sort' => 8,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes.tax-categories',
        'name' => 'vendoradmin::app.layouts.tax-categories',
        'route' => 'vendoradmin.tax-categories.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes.tax-rates',
        'name' => 'vendoradmin::app.layouts.tax-rates',
        'route' => 'vendoradmin.tax-rates.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.development',
        'name' => 'vendoradmin::app.settings.development.title',
        'route' => 'vendoradmin.development.index',
        'sort' => 8,
        'icon-class' => ''
    ],[
        'key' => 'promotions',
        'name' => 'vendoradmin::app.layouts.promotion',
        'route' => 'vendoradmin.cart-rule.index',
        'sort' => 5,
        'icon-class' => 'promotion-icon'
    ], [
        'key' => 'promotions.cart-rule',
        'name' => 'vendoradmin::app.promotion.cart-rule',
        'route' => 'vendoradmin.cart-rule.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'promotions.catalog-rule',
        'name' => 'vendoradmin::app.promotion.catalog-rule',
        'route' => 'vendoradmin.catalog-rule.index',
        'sort' => 1,
        'icon-class' => '',
    ], [
        'key' => 'cms',
        'name' => 'vendoradmin::app.layouts.cms',
        'route' => 'vendoradmin.cms.index',
        'sort' => 5,
        'icon-class' => 'cms-icon'
    ], [
        'key' => 'cms.pages',
        'name' => 'vendoradmin::app.cms.pages.pages',
        'route' => 'vendoradmin.cms.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources',
        'name' => 'vendoradmin::app.layouts.vendor-sources',
        'route' => 'vendoradmin.vendor_sources.index',
        'sort' => 9,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.vendor_sources',
        'name' => 'vendoradmin::app.layouts.vendor-sources',
        'route' => 'vendoradmin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.roles',
        'name' => 'vendoradmin::app.layouts.vendorroles',
        'route' => 'vendoradmin.vendorroles.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources',
        'name' => 'vendoradmin::app.layouts.agent-sources',
        'route' => 'vendoradmin.agent_sources.index',
        'sort' => 10,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources.agent_sources',
        'name' => 'vendoradmin::app.layouts.agent-sources',
        'route' => 'vendoradmin.agent_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources.roles',
        'name' => 'vendoradmin::app.layouts.agentroles',
        'route' => 'vendoradmin.agentroles.index',
        'sort' => 2,
        'icon-class' => ''
    ]
];