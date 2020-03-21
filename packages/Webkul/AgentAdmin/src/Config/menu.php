<?php

return [
    [
        'key' => 'dashboard',
        'name' => 'agentadmin::app.layouts.dashboard',
        'route' => 'agentadmin.dashboard.index',
        'sort' => 1,
        'icon-class' => 'dashboard-icon'
    ], [
        'key' => 'sales',
        'name' => 'agentadmin::app.layouts.sales',
        'route' => 'agentadmin.sales.orders.index',
        'sort' => 2,
        'icon-class' => 'sales-icon'
    ], [
        'key' => 'sales.orders',
        'name' => 'agentadmin::app.layouts.orders',
        'route' => 'agentadmin.sales.orders.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'sales.shipments',
        'name' => 'agentadmin::app.layouts.shipments',
        'route' => 'agentadmin.sales.shipments.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'sales.invoices',
        'name' => 'agentadmin::app.layouts.invoices',
        'route' => 'agentadmin.sales.invoices.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'sales.refunds',
        'name' => 'agentadmin::app.layouts.refunds',
        'route' => 'agentadmin.sales.refunds.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'catalog',
        'name' => 'agentadmin::app.layouts.catalog',
        'route' => 'agentadmin.catalog.products.index',
        'sort' => 3,
        'icon-class' => 'catalog-icon'
    ], [
        'key' => 'catalog.products',
        'name' => 'agentadmin::app.layouts.products',
        'route' => 'agentadmin.catalog.products.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'catalog.categories',
        'name' => 'agentadmin::app.layouts.categories',
        'route' => 'agentadmin.catalog.categories.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'catalog.attributes',
        'name' => 'agentadmin::app.layouts.attributes',
        'route' => 'agentadmin.catalog.attributes.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'catalog.families',
        'name' => 'agentadmin::app.layouts.attribute-families',
        'route' => 'agentadmin.catalog.families.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'customers',
        'name' => 'agentadmin::app.layouts.customers',
        'route' => 'agentadmin.customer.index',
        'sort' => 4,
        'icon-class' => 'customer-icon'
    ], [
        'key' => 'customers.customers',
        'name' => 'agentadmin::app.layouts.customers',
        'route' => 'agentadmin.customer.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'customers.groups',
        'name' => 'agentadmin::app.layouts.groups',
        'route' => 'agentadmin.groups.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'customers.reviews',
        'name' => 'agentadmin::app.layouts.reviews',
        'route' => 'agentadmin.customer.review.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'customers.subscribers',
        'name' => 'agentadmin::app.layouts.newsletter-subscriptions',
        'route' => 'agentadmin.customers.subscribers.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'configuration',
        'name' => 'agentadmin::app.layouts.configure',
        'route' => 'agentadmin.configuration.index',
        'sort' => 7,
        'icon-class' => 'configuration-icon'
    ], [
        'key' => 'settings',
        'name' => 'agentadmin::app.layouts.settings',
        'route' => 'agentadmin.locales.index',
        'sort' => 6,
        'icon-class' => 'settings-icon'
    ], [
        'key' => 'settings.locales',
        'name' => 'agentadmin::app.layouts.locales',
        'route' => 'agentadmin.locales.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.currencies',
        'name' => 'agentadmin::app.layouts.currencies',
        'route' => 'agentadmin.currencies.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.exchange_rates',
        'name' => 'agentadmin::app.layouts.exchange-rates',
        'route' => 'agentadmin.exchange_rates.index',
        'sort' => 3,
        'icon-class' => ''
    ], [
        'key' => 'settings.inventory_sources',
        'name' => 'agentadmin::app.layouts.inventory-sources',
        'route' => 'agentadmin.inventory_sources.index',
        'sort' => 4,
        'icon-class' => ''
    ], [
        'key' => 'settings.channels',
        'name' => 'agentadmin::app.layouts.channels',
        'route' => 'agentadmin.channels.index',
        'sort' => 5,
        'icon-class' => ''
    ], [
        'key' => 'settings.users',
        'name' => 'agentadmin::app.layouts.users',
        'route' => 'agentadmin.users.index',
        'sort' => 6,
        'icon-class' => ''
    ], [
        'key' => 'settings.users.users',
        'name' => 'agentadmin::app.layouts.users',
        'route' => 'agentadmin.users.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.users.roles',
        'name' => 'agentadmin::app.layouts.roles',
        'route' => 'agentadmin.roles.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.sliders',
        'name' => 'agentadmin::app.layouts.sliders',
        'route' => 'agentadmin.sliders.index',
        'sort' => 7,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes',
        'name' => 'agentadmin::app.layouts.taxes',
        'route' => 'agentadmin.tax-categories.index',
        'sort' => 8,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes.tax-categories',
        'name' => 'agentadmin::app.layouts.tax-categories',
        'route' => 'agentadmin.tax-categories.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.taxes.tax-rates',
        'name' => 'agentadmin::app.layouts.tax-rates',
        'route' => 'agentadmin.tax-rates.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.development',
        'name' => 'agentadmin::app.settings.development.title',
        'route' => 'agentadmin.development.index',
        'sort' => 8,
        'icon-class' => ''
    ],[
        'key' => 'promotions',
        'name' => 'agentadmin::app.layouts.promotion',
        'route' => 'agentadmin.cart-rule.index',
        'sort' => 5,
        'icon-class' => 'promotion-icon'
    ], [
        'key' => 'promotions.cart-rule',
        'name' => 'agentadmin::app.promotion.cart-rule',
        'route' => 'agentadmin.cart-rule.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'promotions.catalog-rule',
        'name' => 'agentadmin::app.promotion.catalog-rule',
        'route' => 'agentadmin.catalog-rule.index',
        'sort' => 1,
        'icon-class' => '',
    ], [
        'key' => 'cms',
        'name' => 'agentadmin::app.layouts.cms',
        'route' => 'agentadmin.cms.index',
        'sort' => 5,
        'icon-class' => 'cms-icon'
    ], [
        'key' => 'cms.pages',
        'name' => 'agentadmin::app.cms.pages.pages',
        'route' => 'agentadmin.cms.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources',
        'name' => 'agentadmin::app.layouts.vendor-sources',
        'route' => 'agentadmin.vendor_sources.index',
        'sort' => 9,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.vendor_sources',
        'name' => 'agentadmin::app.layouts.vendor-sources',
        'route' => 'agentadmin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.roles',
        'name' => 'agentadmin::app.layouts.vendorroles',
        'route' => 'agentadmin.vendorroles.index',
        'sort' => 2,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources',
        'name' => 'agentadmin::app.layouts.agent-sources',
        'route' => 'agentadmin.agent_sources.index',
        'sort' => 10,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources.agent_sources',
        'name' => 'agentadmin::app.layouts.agent-sources',
        'route' => 'agentadmin.agent_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources.roles',
        'name' => 'agentadmin::app.layouts.agentroles',
        'route' => 'agentadmin.agentroles.index',
        'sort' => 2,
        'icon-class' => ''
    ]
];