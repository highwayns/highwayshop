<?php

return [
    [
        'key' => 'dashboard',
        'name' => 'vendoradmin::app.acl.dashboard',
        'route' => 'vendoradmin.dashboard.index',
        'sort' => 1
    ], [
        'key' => 'sales',
        'name' => 'vendoradmin::app.acl.sales',
        'route' => 'vendoradmin.sales.orders.index',
        'sort' => 2
    ], [
        'key' => 'sales.orders',
        'name' => 'vendoradmin::app.acl.orders',
        'route' => 'vendoradmin.sales.orders.index',
        'sort' => 1
    ], [
        'key' => 'sales.invoices',
        'name' => 'vendoradmin::app.acl.invoices',
        'route' => 'vendoradmin.sales.invoices.index',
        'sort' => 2
    ], [
        'key' => 'sales.shipments',
        'name' => 'vendoradmin::app.acl.shipments',
        'route' => 'vendoradmin.sales.shipments.index',
        'sort' => 3
    ], [
        'key' => 'catalog',
        'name' => 'vendoradmin::app.acl.catalog',
        'route' => 'vendoradmin.catalog.index',
        'sort' => 3
    ], [
        'key' => 'catalog.products',
        'name' => 'vendoradmin::app.acl.products',
        'route' => 'vendoradmin.catalog.products.index',
        'sort' => 1
    ], [
        'key' => 'catalog.products.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.catalog.products.create',
        'sort' => 1
    ], [
        'key' => 'catalog.products.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.catalog.products.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.products.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.catalog.products.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.categories',
        'name' => 'vendoradmin::app.acl.categories',
        'route' => 'vendoradmin.catalog.categories.index',
        'sort' => 2
    ], [
        'key' => 'catalog.categories.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.catalog.categories.create',
        'sort' => 1
    ], [
        'key' => 'catalog.categories.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.catalog.categories.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.categories.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.catalog.categories.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.attributes',
        'name' => 'vendoradmin::app.acl.attributes',
        'route' => 'vendoradmin.catalog.attributes.index',
        'sort' => 3
    ], [
        'key' => 'catalog.attributes.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.catalog.attributes.create',
        'sort' => 1
    ], [
        'key' => 'catalog.attributes.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.catalog.attributes.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.attributes.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.catalog.attributes.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.families',
        'name' => 'vendoradmin::app.acl.attribute-families',
        'route' => 'vendoradmin.catalog.families.index',
        'sort' => 4
    ], [
        'key' => 'catalog.families.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.catalog.families.create',
        'sort' => 1
    ], [
        'key' => 'catalog.families.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.catalog.families.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.families.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.catalog.families.delete',
        'sort' => 3
    ], [
        'key' => 'customers',
        'name' => 'vendoradmin::app.acl.customers',
        'route' => 'vendoradmin.customer.index',
        'sort' => 4
    ], [
        'key' => 'customers.customers',
        'name' => 'vendoradmin::app.acl.customers',
        'route' => 'vendoradmin.customer.index',
        'sort' => 1
    ], [
        'key' => 'customers.customers.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.customer.create',
        'sort' => 1
    ], [
        'key' => 'customers.customers.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.customer.edit',
        'sort' => 2
    ], [
        'key' => 'customers.customers.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.customer.delete',
        'sort' => 3
    ], [
        'key' => 'customers.groups',
        'name' => 'vendoradmin::app.acl.groups',
        'route' => 'vendoradmin.groups.index',
        'sort' => 2
    ], [
        'key' => 'customers.groups.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.groups.create',
        'sort' => 1
    ], [
        'key' => 'customers.groups.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.groups.edit',
        'sort' => 2
    ], [
        'key' => 'customers.groups.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.groups.delete',
        'sort' => 3
    ], [
        'key' => 'customers.reviews',
        'name' => 'vendoradmin::app.acl.reviews',
        'route' => 'vendoradmin.customer.review.index',
        'sort' => 3
    ], [
        'key' => 'customers.reviews.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.customer.review.edit',
        'sort' => 1
    ], [
        'key' => 'customers.reviews.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.customer.review.delete',
        'sort' => 2
    ], [
        'key' => 'configuration',
        'name' => 'vendoradmin::app.acl.configure',
        'route' => 'vendoradmin.configuration.index',
        'sort' => 5
    ], [
        'key' => 'settings',
        'name' => 'vendoradmin::app.acl.settings',
        'route' => 'vendoradmin.users.index',
        'sort' => 6
    ], [
        'key' => 'settings.locales',
        'name' => 'vendoradmin::app.acl.locales',
        'route' => 'vendoradmin.locales.index',
        'sort' => 1
    ], [
        'key' => 'settings.locales.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.locales.create',
        'sort' => 1
    ], [
        'key' => 'settings.locales.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.locales.edit',
        'sort' => 2
    ], [
        'key' => 'settings.locales.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.locales.delete',
        'sort' => 3
    ], [
        'key' => 'settings.currencies',
        'name' => 'vendoradmin::app.acl.currencies',
        'route' => 'vendoradmin.currencies.index',
        'sort' => 2
    ], [
        'key' => 'settings.currencies.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.currencies.create',
        'sort' => 1
    ], [
        'key' => 'settings.currencies.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.currencies.edit',
        'sort' => 2
    ], [
        'key' => 'settings.currencies.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.currencies.delete',
        'sort' => 3
    ], [
        'key' => 'settings.exchange_rates',
        'name' => 'vendoradmin::app.acl.exchange-rates',
        'route' => 'vendoradmin.exchange_rates.index',
        'sort' => 3
    ], [
        'key' => 'settings.exchange_rates.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.exchange_rates.create',
        'sort' => 1
    ], [
        'key' => 'settings.exchange_rates.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.exchange_rates.edit',
        'sort' => 2
    ], [
        'key' => 'settings.exchange_rates.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.exchange_rates.delete',
        'sort' => 3
    ], [
        'key' => 'settings.inventory_sources',
        'name' => 'vendoradmin::app.acl.inventory-sources',
        'route' => 'vendoradmin.inventory_sources.index',
        'sort' => 4
    ], [
        'key' => 'settings.inventory_sources.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.inventory_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.inventory_sources.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.inventory_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.inventory_sources.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.inventory_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.channels',
        'name' => 'vendoradmin::app.acl.channels',
        'route' => 'vendoradmin.channels.index',
        'sort' => 5
    ], [
        'key' => 'settings.channels.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.channels.create',
        'sort' => 1
    ], [
        'key' => 'settings.channels.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.channels.edit',
        'sort' => 2
    ], [
        'key' => 'settings.channels.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.channels.delete',
        'sort' => 3
    ], [
        'key' => 'settings.users',
        'name' => 'vendoradmin::app.acl.users',
        'route' => 'vendoradmin.users.index',
        'sort' => 6
    ], [
        'key' => 'settings.users.users',
        'name' => 'vendoradmin::app.acl.users',
        'route' => 'vendoradmin.users.index',
        'sort' => 1
    ], [
        'key' => 'settings.users.users.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.users.create',
        'sort' => 1
    ], [
        'key' => 'settings.users.users.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.users.edit',
        'sort' => 2
    ], [
        'key' => 'settings.users.users.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.users.delete',
        'sort' => 3
    ], [
        'key' => 'settings.users.roles',
        'name' => 'vendoradmin::app.acl.roles',
        'route' => 'vendoradmin.roles.index',
        'sort' => 2
    ], [
        'key' => 'settings.users.roles.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.roles.create',
        'sort' => 1
    ], [
        'key' => 'settings.users.roles.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.roles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.users.roles.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.roles.delete',
        'sort' => 3
    ], [
        'key' => 'settings.sliders',
        'name' => 'vendoradmin::app.acl.sliders',
        'route' => 'vendoradmin.sliders.index',
        'sort' => 7
    ], [
        'key' => 'settings.sliders.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.sliders.create',
        'sort' => 1
    ], [
        'key' => 'settings.sliders.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.sliders.edit',
        'sort' => 2
    ], [
        'key' => 'settings.sliders.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.sliders.delete',
        'sort' => 3
    ], [
        'key' => 'settings.taxes',
        'name' => 'vendoradmin::app.acl.taxes',
        'route' => 'vendoradmin.tax-categories.index',
        'sort' => 8
    ], [
        'key' => 'settings.taxes.tax-categories',
        'name' => 'vendoradmin::app.acl.tax-categories',
        'route' => 'vendoradmin.tax-categories.index',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-categories.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.tax-categories.create',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-categories.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.tax-categories.edit',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-categories.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.tax-categories.delete',
        'sort' => 3
    ], [
        'key' => 'settings.taxes.tax-rates',
        'name' => 'vendoradmin::app.acl.tax-rates',
        'route' => 'vendoradmin.tax-rates.index',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-rates.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.tax-rates.create',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-rates.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.tax-rates.edit',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-rates.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.tax-rates.delete',
        'sort' => 3
    ], [
        'key' => 'promotions',
        'name' => 'vendoradmin::app.acl.promotions',
        'route' => 'vendoradmin.cart-rule.index',
        'sort' => 7
    ], [
        'key' => 'promotions.cart-rule',
        'name' => 'vendoradmin::app.acl.cart-rules',
        'route' => 'vendoradmin.cart-rule.index',
        'sort' => 1
    ], [
        'key' => 'promotions.cart-rule.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.cart-rule.create',
        'sort' => 1
    ], [
        'key' => 'promotions.cart-rule.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.cart-rule.edit',
        'sort' => 2
    ], [
        'key' => 'promotions.cart-rule.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.cart-rule.delete',
        'sort' => 3
    ], [
        'key' => 'settings.vendor_sources',
        'name' => 'vendoradmin::app.acl.vendor-sources',
        'route' => 'vendoradmin.vendor_sources.index',
        'sort' => 9
    ], [
        'key' => 'settings.vendor_sources.vendor_sources',
        'name' => 'vendoradmin::app.layouts.vendor-sources',
        'route' => 'vendoradmin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.vendor_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.vendor_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.vendor_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.vendor_sources.roles',
        'name' => 'vendoradmin::app.acl.roles',
        'route' => 'vendoradmin.vendorroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.vendorroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.roles.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.vendorroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.vendorroles.delete',
        'sort' => 3
    ], [
        'key' => 'settings.agent_sources',
        'name' => 'vendoradmin::app.acl.agent-sources',
        'route' => 'vendoradmin.agent_sources.index',
        'sort' => 10
    ], [
        'key' => 'settings.agent_sources.agent_sources',
        'name' => 'vendoradmin::app.layouts.agent-sources',
        'route' => 'vendoradmin.agent_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.agent_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.agent_sources.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.agent_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.agent_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.agent_sources.roles',
        'name' => 'vendoradmin::app.acl.roles',
        'route' => 'vendoradmin.agentroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.roles.create',
        'name' => 'vendoradmin::app.acl.create',
        'route' => 'vendoradmin.agentroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.agent_sources.roles.edit',
        'name' => 'vendoradmin::app.acl.edit',
        'route' => 'vendoradmin.agentroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.roles.delete',
        'name' => 'vendoradmin::app.acl.delete',
        'route' => 'vendoradmin.agentroles.delete',
        'sort' => 3
    ]
];

?>