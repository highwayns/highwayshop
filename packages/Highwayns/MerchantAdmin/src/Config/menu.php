<?php

return [
    [
        'key' => 'dashboard',
        'name' => 'merchantadmin::app.layouts.dashboard',
        'route' => 'merchantadmin.dashboard.index',
        'sort' => 1,
        'icon-class' => 'dashboard-icon'
    ], [
        'key' => 'sales',
        'name' => 'merchantadmin::app.layouts.sales',
        'route' => 'merchantadmin.sales.orders.index',
        'sort' => 2,
        'icon-class' => 'sales-icon'
    ], [
        'key' => 'sales.orders',
        'name' => 'merchantadmin::app.layouts.orders',
        'route' => 'merchantadmin.sales.orders.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'sales.shipments',
        'name' => 'merchantadmin::app.layouts.shipments',
        'route' => 'merchantadmin.sales.shipments.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'sales.invoices',
        'name' => 'merchantadmin::app.layouts.invoices',
        'route' => 'merchantadmin.sales.invoices.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'sales.refunds',
        'name' => 'merchantadmin::app.layouts.refunds',
        'route' => 'merchantadmin.sales.refunds.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'catalog',
        'name' => 'merchantadmin::app.layouts.catalog',
        'route' => 'merchantadmin.catalog.products.index',
        'sort' => 3,
        'icon-class' => 'catalog-icon'
    ], [
        'key' => 'catalog.products',
        'name' => 'merchantadmin::app.layouts.products',
        'route' => 'merchantadmin.catalog.products.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'catalog.categories',
        'name' => 'merchantadmin::app.layouts.categories',
        'route' => 'merchantadmin.catalog.categories.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'catalog.attributes',
        'name' => 'merchantadmin::app.layouts.attributes',
        'route' => 'merchantadmin.catalog.attributes.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'catalog.families',
        'name' => 'merchantadmin::app.layouts.attribute-families',
        'route' => 'merchantadmin.catalog.families.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'customers',
        'name' => 'merchantadmin::app.layouts.customers',
        'route' => 'merchantadmin.customer.index',
        'sort' => 4,
        'icon-class' => 'customer-icon'
    ], [
        'key' => 'customers.customers',
        'name' => 'merchantadmin::app.layouts.customers',
        'route' => 'merchantadmin.customer.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'customers.groups',
        'name' => 'merchantadmin::app.layouts.groups',
        'route' => 'merchantadmin.groups.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'customers.reviews',
        'name' => 'merchantadmin::app.layouts.reviews',
        'route' => 'merchantadmin.customer.review.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'customers.subscribers',
        'name' => 'merchantadmin::app.layouts.newsletter-subscriptions',
        'route' => 'merchantadmin.customers.subscribers.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'configuration',
        'name' => 'merchantadmin::app.layouts.configure',
        'route' => 'merchantadmin.configuration.index',
        'sort' => 7,
        'icon-class' => 'configuration-icon'
    ], [
        'key' => 'settings',
        'name' => 'merchantadmin::app.layouts.settings',
        'route' => 'merchantadmin.locales.index',
        'sort' => 6,
        'icon-class' => 'settings-icon'
    ], [
        'key' => 'settings.locales',
        'name' => 'merchantadmin::app.layouts.locales',
        'route' => 'merchantadmin.locales.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.currencies',
        'name' => 'merchantadmin::app.layouts.currencies',
        'route' => 'merchantadmin.currencies.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.exchange_rates',
        'name' => 'merchantadmin::app.layouts.exchange-rates',
        'route' => 'merchantadmin.exchange_rates.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'settings.inventory_sources',
        'name' => 'merchantadmin::app.layouts.inventory-sources',
        'route' => 'merchantadmin.inventory_sources.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'settings.channels',
        'name' => 'merchantadmin::app.layouts.channels',
        'route' => 'merchantadmin.channels.index',
        'sort' => 5,
        'icon-class' => ''
    ], [
        'key' => 'settings.users',
        'name' => 'merchantadmin::app.layouts.users',
        'route' => 'merchantadmin.users.index',
        'sort' => 6,
        'icon-class' => ''
    ], [
        'key' => 'settings.users.users',
        'name' => 'merchantadmin::app.layouts.users',
        'route' => 'merchantadmin.users.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.users.roles',
        'name' => 'merchantadmin::app.layouts.roles',
        'route' => 'merchantadmin.roles.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.sliders',
        'name' => 'merchantadmin::app.layouts.sliders',
        'route' => 'merchantadmin.sliders.index',
        'sort' => 7,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes',
        'name' => 'merchantadmin::app.layouts.taxes',
        'route' => 'merchantadmin.tax-categories.index',
        'sort' => 8,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes.tax-categories',
        'name' => 'merchantadmin::app.layouts.tax-categories',
        'route' => 'merchantadmin.tax-categories.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes.tax-rates',
        'name' => 'merchantadmin::app.layouts.tax-rates',
        'route' => 'merchantadmin.tax-rates.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.development',
        'name' => 'merchantadmin::app.settings.development.title',
        'route' => 'merchantadmin.development.index',
        'sort' => 8,
        'icon-class' => ''
    ],[
        'key' => 'promotions',
        'name' => 'merchantadmin::app.layouts.promotion',
        'route' => 'merchantadmin.cart-rule.index',
        'sort' => 5,
        'icon-class' => 'promotion-icon'
    ], [
        'key' => 'promotions.cart-rule',
        'name' => 'merchantadmin::app.promotion.cart-rule',
        'route' => 'merchantadmin.cart-rule.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'promotions.catalog-rule',
        'name' => 'merchantadmin::app.promotion.catalog-rule',
        'route' => 'merchantadmin.catalog-rule.index',
        'sort' => 1,
        'icon-class' => '',
    ], [
        'key' => 'cms',
        'name' => 'merchantadmin::app.layouts.cms',
        'route' => 'merchantadmin.cms.index',
        'sort' => 5,
        'icon-class' => 'cms-icon'
    ], [
        'key' => 'cms.pages',
        'name' => 'merchantadmin::app.cms.pages.pages',
        'route' => 'merchantadmin.cms.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources',
        'name' => 'merchantadmin::app.layouts.vendor-sources',
        'route' => 'merchantadmin.vendor_sources.index',
        'sort' => 9,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.vendor_sources',
        'name' => 'merchantadmin::app.layouts.vendor-sources',
        'route' => 'merchantadmin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.roles',
        'name' => 'merchantadmin::app.layouts.vendorroles',
        'route' => 'merchantadmin.vendorroles.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.merchant_sources',
        'name' => 'merchantadmin::app.layouts.merchant-sources',
        'route' => 'merchantadmin.merchant_sources.index',
        'sort' => 10,
        'icon-class' => ''
    ], [
        'key' => 'settings.merchant_sources.merchant_sources',
        'name' => 'merchantadmin::app.layouts.merchant-sources',
        'route' => 'merchantadmin.merchant_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.merchant_sources.roles',
        'name' => 'merchantadmin::app.layouts.merchantroles',
        'route' => 'merchantadmin.merchantroles.index',
        'sort' => 2,
        'icon-class' => ''
    ]
];