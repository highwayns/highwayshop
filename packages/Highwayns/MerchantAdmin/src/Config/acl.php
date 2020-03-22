<?php

return [
    [
        'key' => 'dashboard',
        'name' => 'admin::app.acl.dashboard',
        'route' => 'merchantadmin.dashboard.index',
        'sort' => 1
    ], [
        'key' => 'sales',
        'name' => 'admin::app.acl.sales',
        'route' => 'merchantadmin.sales.orders.index',
        'sort' => 2
    ], [
        'key' => 'sales.orders',
        'name' => 'admin::app.acl.orders',
        'route' => 'merchantadmin.sales.orders.index',
        'sort' => 1
    ], [
        'key' => 'sales.invoices',
        'name' => 'admin::app.acl.invoices',
        'route' => 'merchantadmin.sales.invoices.index',
        'sort' => 2
    ], [
        'key' => 'sales.shipments',
        'name' => 'admin::app.acl.shipments',
        'route' => 'merchantadmin.sales.shipments.index',
        'sort' => 3
    ], [
        'key' => 'catalog',
        'name' => 'admin::app.acl.catalog',
        'route' => 'merchantadmin.catalog.index',
        'sort' => 3
    ], [
        'key' => 'catalog.products',
        'name' => 'admin::app.acl.products',
        'route' => 'merchantadmin.catalog.products.index',
        'sort' => 1
    ], [
        'key' => 'catalog.products.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.catalog.products.create',
        'sort' => 1
    ], [
        'key' => 'catalog.products.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.catalog.products.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.products.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.catalog.products.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.categories',
        'name' => 'admin::app.acl.categories',
        'route' => 'merchantadmin.catalog.categories.index',
        'sort' => 2
    ], [
        'key' => 'catalog.categories.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.catalog.categories.create',
        'sort' => 1
    ], [
        'key' => 'catalog.categories.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.catalog.categories.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.categories.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.catalog.categories.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.attributes',
        'name' => 'admin::app.acl.attributes',
        'route' => 'merchantadmin.catalog.attributes.index',
        'sort' => 3
    ], [
        'key' => 'catalog.attributes.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.catalog.attributes.create',
        'sort' => 1
    ], [
        'key' => 'catalog.attributes.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.catalog.attributes.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.attributes.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.catalog.attributes.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.families',
        'name' => 'admin::app.acl.attribute-families',
        'route' => 'merchantadmin.catalog.families.index',
        'sort' => 4
    ], [
        'key' => 'catalog.families.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.catalog.families.create',
        'sort' => 1
    ], [
        'key' => 'catalog.families.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.catalog.families.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.families.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.catalog.families.delete',
        'sort' => 3
    ], [
        'key' => 'customers',
        'name' => 'admin::app.acl.customers',
        'route' => 'merchantadmin.customer.index',
        'sort' => 4
    ], [
        'key' => 'customers.customers',
        'name' => 'admin::app.acl.customers',
        'route' => 'merchantadmin.customer.index',
        'sort' => 1
    ], [
        'key' => 'customers.customers.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.customer.create',
        'sort' => 1
    ], [
        'key' => 'customers.customers.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.customer.edit',
        'sort' => 2
    ], [
        'key' => 'customers.customers.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.customer.delete',
        'sort' => 3
    ], [
        'key' => 'customers.groups',
        'name' => 'admin::app.acl.groups',
        'route' => 'merchantadmin.groups.index',
        'sort' => 2
    ], [
        'key' => 'customers.groups.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.groups.create',
        'sort' => 1
    ], [
        'key' => 'customers.groups.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.groups.edit',
        'sort' => 2
    ], [
        'key' => 'customers.groups.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.groups.delete',
        'sort' => 3
    ], [
        'key' => 'customers.reviews',
        'name' => 'admin::app.acl.reviews',
        'route' => 'merchantadmin.customer.review.index',
        'sort' => 3
    ], [
        'key' => 'customers.reviews.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.customer.review.edit',
        'sort' => 1
    ], [
        'key' => 'customers.reviews.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.customer.review.delete',
        'sort' => 2
    ], [
        'key' => 'configuration',
        'name' => 'admin::app.acl.configure',
        'route' => 'merchantadmin.configuration.index',
        'sort' => 5
    ], [
        'key' => 'settings',
        'name' => 'admin::app.acl.settings',
        'route' => 'merchantadmin.users.index',
        'sort' => 6
    ], [
        'key' => 'settings.locales',
        'name' => 'admin::app.acl.locales',
        'route' => 'merchantadmin.locales.index',
        'sort' => 1
    ], [
        'key' => 'settings.locales.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.locales.create',
        'sort' => 1
    ], [
        'key' => 'settings.locales.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.locales.edit',
        'sort' => 2
    ], [
        'key' => 'settings.locales.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.locales.delete',
        'sort' => 3
    ], [
        'key' => 'settings.currencies',
        'name' => 'admin::app.acl.currencies',
        'route' => 'merchantadmin.currencies.index',
        'sort' => 2
    ], [
        'key' => 'settings.currencies.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.currencies.create',
        'sort' => 1
    ], [
        'key' => 'settings.currencies.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.currencies.edit',
        'sort' => 2
    ], [
        'key' => 'settings.currencies.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.currencies.delete',
        'sort' => 3
    ], [
        'key' => 'settings.exchange_rates',
        'name' => 'admin::app.acl.exchange-rates',
        'route' => 'merchantadmin.exchange_rates.index',
        'sort' => 3
    ], [
        'key' => 'settings.exchange_rates.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.exchange_rates.create',
        'sort' => 1
    ], [
        'key' => 'settings.exchange_rates.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.exchange_rates.edit',
        'sort' => 2
    ], [
        'key' => 'settings.exchange_rates.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.exchange_rates.delete',
        'sort' => 3
    ], [
        'key' => 'settings.inventory_sources',
        'name' => 'admin::app.acl.inventory-sources',
        'route' => 'merchantadmin.inventory_sources.index',
        'sort' => 4
    ], [
        'key' => 'settings.inventory_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.inventory_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.inventory_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.inventory_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.inventory_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.inventory_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.channels',
        'name' => 'admin::app.acl.channels',
        'route' => 'merchantadmin.channels.index',
        'sort' => 5
    ], [
        'key' => 'settings.channels.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.channels.create',
        'sort' => 1
    ], [
        'key' => 'settings.channels.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.channels.edit',
        'sort' => 2
    ], [
        'key' => 'settings.channels.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.channels.delete',
        'sort' => 3
    ], [
        'key' => 'settings.users',
        'name' => 'admin::app.acl.users',
        'route' => 'merchantadmin.users.index',
        'sort' => 6
    ], [
        'key' => 'settings.users.users',
        'name' => 'admin::app.acl.users',
        'route' => 'merchantadmin.users.index',
        'sort' => 1
    ], [
        'key' => 'settings.users.users.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.users.create',
        'sort' => 1
    ], [
        'key' => 'settings.users.users.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.users.edit',
        'sort' => 2
    ], [
        'key' => 'settings.users.users.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.users.delete',
        'sort' => 3
    ], [
        'key' => 'settings.users.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'merchantadmin.roles.index',
        'sort' => 2
    ], [
        'key' => 'settings.users.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.roles.create',
        'sort' => 1
    ], [
        'key' => 'settings.users.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.roles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.users.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.roles.delete',
        'sort' => 3
    ], [
        'key' => 'settings.sliders',
        'name' => 'admin::app.acl.sliders',
        'route' => 'merchantadmin.sliders.index',
        'sort' => 7
    ], [
        'key' => 'settings.sliders.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.sliders.create',
        'sort' => 1
    ], [
        'key' => 'settings.sliders.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.sliders.edit',
        'sort' => 2
    ], [
        'key' => 'settings.sliders.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.sliders.delete',
        'sort' => 3
    ], [
        'key' => 'settings.taxes',
        'name' => 'admin::app.acl.taxes',
        'route' => 'merchantadmin.tax-categories.index',
        'sort' => 8
    ], [
        'key' => 'settings.taxes.tax-categories',
        'name' => 'admin::app.acl.tax-categories',
        'route' => 'merchantadmin.tax-categories.index',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-categories.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.tax-categories.create',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-categories.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.tax-categories.edit',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-categories.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.tax-categories.delete',
        'sort' => 3
    ], [
        'key' => 'settings.taxes.tax-rates',
        'name' => 'admin::app.acl.tax-rates',
        'route' => 'merchantadmin.tax-rates.index',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-rates.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.tax-rates.create',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-rates.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.tax-rates.edit',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-rates.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.tax-rates.delete',
        'sort' => 3
    ], [
        'key' => 'promotions',
        'name' => 'admin::app.acl.promotions',
        'route' => 'merchantadmin.cart-rule.index',
        'sort' => 7
    ], [
        'key' => 'promotions.cart-rule',
        'name' => 'admin::app.acl.cart-rules',
        'route' => 'merchantadmin.cart-rule.index',
        'sort' => 1
    ], [
        'key' => 'promotions.cart-rule.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.cart-rule.create',
        'sort' => 1
    ], [
        'key' => 'promotions.cart-rule.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.cart-rule.edit',
        'sort' => 2
    ], [
        'key' => 'promotions.cart-rule.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.cart-rule.delete',
        'sort' => 3
    ], [
        'key' => 'settings.vendor_sources',
        'name' => 'admin::app.acl.vendor-sources',
        'route' => 'merchantadmin.vendor_sources.index',
        'sort' => 9
    ], [
        'key' => 'settings.vendor_sources.vendor_sources',
        'name' => 'admin::app.layouts.vendor-sources',
        'route' => 'merchantadmin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.vendor_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.vendor_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.vendor_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.vendor_sources.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'merchantadmin.vendorroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.vendorroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.vendorroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.vendorroles.delete',
        'sort' => 3
    ], [
        'key' => 'settings.merchant_sources',
        'name' => 'admin::app.acl.merchant-sources',
        'route' => 'merchantadmin.merchant_sources.index',
        'sort' => 10
    ], [
        'key' => 'settings.merchant_sources.merchant_sources',
        'name' => 'admin::app.layouts.merchant-sources',
        'route' => 'merchantadmin.merchant_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.merchant_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.merchant_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.merchant_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.merchant_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.merchant_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.merchant_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.merchant_sources.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'merchantadmin.merchantroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.merchant_sources.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'merchantadmin.merchantroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.merchant_sources.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'merchantadmin.merchantroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.merchant_sources.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'merchantadmin.merchantroles.delete',
        'sort' => 3
    ]
];

?>