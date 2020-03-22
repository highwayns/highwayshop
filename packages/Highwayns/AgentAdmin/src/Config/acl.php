<?php

return [
    [
        'key' => 'dashboard',
        'name' => 'admin::app.acl.dashboard',
        'route' => 'agentadmin.dashboard.index',
        'sort' => 1
    ], [
        'key' => 'sales',
        'name' => 'admin::app.acl.sales',
        'route' => 'agentadmin.sales.orders.index',
        'sort' => 2
    ], [
        'key' => 'sales.orders',
        'name' => 'admin::app.acl.orders',
        'route' => 'agentadmin.sales.orders.index',
        'sort' => 1
    ], [
        'key' => 'sales.invoices',
        'name' => 'admin::app.acl.invoices',
        'route' => 'agentadmin.sales.invoices.index',
        'sort' => 2
    ], [
        'key' => 'sales.shipments',
        'name' => 'admin::app.acl.shipments',
        'route' => 'agentadmin.sales.shipments.index',
        'sort' => 3
    ], [
        'key' => 'catalog',
        'name' => 'admin::app.acl.catalog',
        'route' => 'agentadmin.catalog.index',
        'sort' => 3
    ], [
        'key' => 'catalog.products',
        'name' => 'admin::app.acl.products',
        'route' => 'agentadmin.catalog.products.index',
        'sort' => 1
    ], [
        'key' => 'catalog.products.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.catalog.products.create',
        'sort' => 1
    ], [
        'key' => 'catalog.products.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.catalog.products.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.products.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.catalog.products.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.categories',
        'name' => 'admin::app.acl.categories',
        'route' => 'agentadmin.catalog.categories.index',
        'sort' => 2
    ], [
        'key' => 'catalog.categories.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.catalog.categories.create',
        'sort' => 1
    ], [
        'key' => 'catalog.categories.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.catalog.categories.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.categories.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.catalog.categories.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.attributes',
        'name' => 'admin::app.acl.attributes',
        'route' => 'agentadmin.catalog.attributes.index',
        'sort' => 3
    ], [
        'key' => 'catalog.attributes.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.catalog.attributes.create',
        'sort' => 1
    ], [
        'key' => 'catalog.attributes.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.catalog.attributes.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.attributes.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.catalog.attributes.delete',
        'sort' => 3
    ], [
        'key' => 'catalog.families',
        'name' => 'admin::app.acl.attribute-families',
        'route' => 'agentadmin.catalog.families.index',
        'sort' => 4
    ], [
        'key' => 'catalog.families.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.catalog.families.create',
        'sort' => 1
    ], [
        'key' => 'catalog.families.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.catalog.families.edit',
        'sort' => 2
    ], [
        'key' => 'catalog.families.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.catalog.families.delete',
        'sort' => 3
    ], [
        'key' => 'customers',
        'name' => 'admin::app.acl.customers',
        'route' => 'agentadmin.customer.index',
        'sort' => 4
    ], [
        'key' => 'customers.customers',
        'name' => 'admin::app.acl.customers',
        'route' => 'agentadmin.customer.index',
        'sort' => 1
    ], [
        'key' => 'customers.customers.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.customer.create',
        'sort' => 1
    ], [
        'key' => 'customers.customers.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.customer.edit',
        'sort' => 2
    ], [
        'key' => 'customers.customers.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.customer.delete',
        'sort' => 3
    ], [
        'key' => 'customers.groups',
        'name' => 'admin::app.acl.groups',
        'route' => 'agentadmin.groups.index',
        'sort' => 2
    ], [
        'key' => 'customers.groups.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.groups.create',
        'sort' => 1
    ], [
        'key' => 'customers.groups.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.groups.edit',
        'sort' => 2
    ], [
        'key' => 'customers.groups.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.groups.delete',
        'sort' => 3
    ], [
        'key' => 'customers.reviews',
        'name' => 'admin::app.acl.reviews',
        'route' => 'agentadmin.customer.review.index',
        'sort' => 3
    ], [
        'key' => 'customers.reviews.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.customer.review.edit',
        'sort' => 1
    ], [
        'key' => 'customers.reviews.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.customer.review.delete',
        'sort' => 2
    ], [
        'key' => 'configuration',
        'name' => 'admin::app.acl.configure',
        'route' => 'agentadmin.configuration.index',
        'sort' => 5
    ], [
        'key' => 'settings',
        'name' => 'admin::app.acl.settings',
        'route' => 'agentadmin.users.index',
        'sort' => 6
    ], [
        'key' => 'settings.locales',
        'name' => 'admin::app.acl.locales',
        'route' => 'agentadmin.locales.index',
        'sort' => 1
    ], [
        'key' => 'settings.locales.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.locales.create',
        'sort' => 1
    ], [
        'key' => 'settings.locales.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.locales.edit',
        'sort' => 2
    ], [
        'key' => 'settings.locales.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.locales.delete',
        'sort' => 3
    ], [
        'key' => 'settings.currencies',
        'name' => 'admin::app.acl.currencies',
        'route' => 'agentadmin.currencies.index',
        'sort' => 2
    ], [
        'key' => 'settings.currencies.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.currencies.create',
        'sort' => 1
    ], [
        'key' => 'settings.currencies.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.currencies.edit',
        'sort' => 2
    ], [
        'key' => 'settings.currencies.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.currencies.delete',
        'sort' => 3
    ], [
        'key' => 'settings.exchange_rates',
        'name' => 'admin::app.acl.exchange-rates',
        'route' => 'agentadmin.exchange_rates.index',
        'sort' => 3
    ], [
        'key' => 'settings.exchange_rates.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.exchange_rates.create',
        'sort' => 1
    ], [
        'key' => 'settings.exchange_rates.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.exchange_rates.edit',
        'sort' => 2
    ], [
        'key' => 'settings.exchange_rates.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.exchange_rates.delete',
        'sort' => 3
    ], [
        'key' => 'settings.inventory_sources',
        'name' => 'admin::app.acl.inventory-sources',
        'route' => 'agentadmin.inventory_sources.index',
        'sort' => 4
    ], [
        'key' => 'settings.inventory_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.inventory_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.inventory_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.inventory_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.inventory_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.inventory_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.channels',
        'name' => 'admin::app.acl.channels',
        'route' => 'agentadmin.channels.index',
        'sort' => 5
    ], [
        'key' => 'settings.channels.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.channels.create',
        'sort' => 1
    ], [
        'key' => 'settings.channels.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.channels.edit',
        'sort' => 2
    ], [
        'key' => 'settings.channels.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.channels.delete',
        'sort' => 3
    ], [
        'key' => 'settings.users',
        'name' => 'admin::app.acl.users',
        'route' => 'agentadmin.users.index',
        'sort' => 6
    ], [
        'key' => 'settings.users.users',
        'name' => 'admin::app.acl.users',
        'route' => 'agentadmin.users.index',
        'sort' => 1
    ], [
        'key' => 'settings.users.users.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.users.create',
        'sort' => 1
    ], [
        'key' => 'settings.users.users.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.users.edit',
        'sort' => 2
    ], [
        'key' => 'settings.users.users.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.users.delete',
        'sort' => 3
    ], [
        'key' => 'settings.users.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'agentadmin.roles.index',
        'sort' => 2
    ], [
        'key' => 'settings.users.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.roles.create',
        'sort' => 1
    ], [
        'key' => 'settings.users.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.roles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.users.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.roles.delete',
        'sort' => 3
    ], [
        'key' => 'settings.sliders',
        'name' => 'admin::app.acl.sliders',
        'route' => 'agentadmin.sliders.index',
        'sort' => 7
    ], [
        'key' => 'settings.sliders.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.sliders.create',
        'sort' => 1
    ], [
        'key' => 'settings.sliders.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.sliders.edit',
        'sort' => 2
    ], [
        'key' => 'settings.sliders.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.sliders.delete',
        'sort' => 3
    ], [
        'key' => 'settings.taxes',
        'name' => 'admin::app.acl.taxes',
        'route' => 'agentadmin.tax-categories.index',
        'sort' => 8
    ], [
        'key' => 'settings.taxes.tax-categories',
        'name' => 'admin::app.acl.tax-categories',
        'route' => 'agentadmin.tax-categories.index',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-categories.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.tax-categories.create',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-categories.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.tax-categories.edit',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-categories.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.tax-categories.delete',
        'sort' => 3
    ], [
        'key' => 'settings.taxes.tax-rates',
        'name' => 'admin::app.acl.tax-rates',
        'route' => 'agentadmin.tax-rates.index',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-rates.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.tax-rates.create',
        'sort' => 1
    ], [
        'key' => 'settings.taxes.tax-rates.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.tax-rates.edit',
        'sort' => 2
    ], [
        'key' => 'settings.taxes.tax-rates.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.tax-rates.delete',
        'sort' => 3
    ], [
        'key' => 'promotions',
        'name' => 'admin::app.acl.promotions',
        'route' => 'agentadmin.cart-rule.index',
        'sort' => 7
    ], [
        'key' => 'promotions.cart-rule',
        'name' => 'admin::app.acl.cart-rules',
        'route' => 'agentadmin.cart-rule.index',
        'sort' => 1
    ], [
        'key' => 'promotions.cart-rule.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.cart-rule.create',
        'sort' => 1
    ], [
        'key' => 'promotions.cart-rule.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.cart-rule.edit',
        'sort' => 2
    ], [
        'key' => 'promotions.cart-rule.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.cart-rule.delete',
        'sort' => 3
    ], [
        'key' => 'settings.vendor_sources',
        'name' => 'admin::app.acl.vendor-sources',
        'route' => 'agentadmin.vendor_sources.index',
        'sort' => 9
    ], [
        'key' => 'settings.vendor_sources.vendor_sources',
        'name' => 'admin::app.layouts.vendor-sources',
        'route' => 'agentadmin.vendor_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.vendor_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.vendor_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.vendor_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.vendor_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.vendor_sources.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'agentadmin.vendorroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.vendorroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.vendor_sources.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.vendorroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.vendor_sources.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.vendorroles.delete',
        'sort' => 3
    ], [
        'key' => 'settings.agent_sources',
        'name' => 'admin::app.acl.agent-sources',
        'route' => 'agentadmin.agent_sources.index',
        'sort' => 10
    ], [
        'key' => 'settings.agent_sources.agent_sources',
        'name' => 'admin::app.layouts.agent-sources',
        'route' => 'agentadmin.agent_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.agent_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.agent_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.agent_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.agent_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.agent_sources.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'agentadmin.agentroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'agentadmin.agentroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.agent_sources.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'agentadmin.agentroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'agentadmin.agentroles.delete',
        'sort' => 3
    ]
];

?>