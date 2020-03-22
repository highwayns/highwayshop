<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| All the routes for the Shopify App setup.
|
*/

Route::group(['prefix' => config('shopify-app.prefix'), 'middleware' => ['web']], function () {
    /*
    |--------------------------------------------------------------------------
    | Home Route
    |--------------------------------------------------------------------------
    |
    | Homepage for an authenticated store. Store is checked with the auth.shop
    | middleware and redirected to login if not.
    |
    */

    Route::get(
        '/shopify',
        'Highwayns\ShopifyAdmin\Http\Controllers\HomeController@index'
    )
    ->middleware(['auth.shopify', 'billable'])
    ->name('home');

    /*
    |--------------------------------------------------------------------------
    | Login Route
    |--------------------------------------------------------------------------
    |
    | Allows a shop to login/install.
    |
    */

    Route::get(
        '/login',
        'Highwayns\ShopifyAdmin\Http\Controllers\AuthController@index'
    )->name('login');

    /*
    |--------------------------------------------------------------------------
    | Authenticate Method
    |--------------------------------------------------------------------------
    |
    | Authenticates a shop.
    |
    */

    Route::match(
        ['get', 'post'],
        '/authenticate',
        'Highwayns\ShopifyAdmin\Http\Controllers\AuthController@authenticate'
    )
    ->name('authenticate');

    /*
    |--------------------------------------------------------------------------
    | Authenticate OAuth
    |--------------------------------------------------------------------------
    |
    | Redirect to Shopify's OAuth screen.
    |
    */

    Route::get(
        '/authenticate/oauth',
        'Highwayns\ShopifyAdmin\Http\Controllers\AuthController@oauth'
    )
    ->name('authenticate.oauth');

    /*
    |--------------------------------------------------------------------------
    | Billing Handler
    |--------------------------------------------------------------------------
    |
    | Billing handler. Sends to billing screen for Shopify.
    |
    */

    Route::get(
        '/billing/{plan?}',
        'Highwayns\ShopifyAdmin\Http\Controllers\BillingController@index'
    )
    ->middleware(['auth.shopify'])
    ->where('plan', '^([0-9]+|)$')
    ->name('billing');

    /*
    |--------------------------------------------------------------------------
    | Billing Processor
    |--------------------------------------------------------------------------
    |
    | Processes the customer's response to the billing screen.
    |
    */

    Route::get(
        '/billing/process/{plan?}',
        'Highwayns\ShopifyAdmin\Http\Controllers\BillingController@process'
    )
    ->middleware(['auth.shopify'])
    ->where('plan', '^([0-9]+|)$')
    ->name('billing.process');

    /*
    |--------------------------------------------------------------------------
    | Billing Processor for Usage Charges
    |--------------------------------------------------------------------------
    |
    | Creates a usage charge on a recurring charge.
    |
    */

    Route::match(
        ['get', 'post'],
        '/billing/usage-charge',
        'Highwayns\ShopifyAdmin\Http\Controllers\BillingController@usageCharge'
    )
    ->middleware(['auth.shopify'])
    ->name('billing.usage_charge');
});

Route::group(['middleware' => ['api']], function () {
    /*
    |--------------------------------------------------------------------------
    | Webhook Handler
    |--------------------------------------------------------------------------
    |
    | Handles incoming webhooks.
    |
    */

    Route::post(
        '/webhook/{type}',
        'Highwayns\ShopifyAdmin\Http\Controllers\WebhookController@handle'
    )
    ->middleware('auth.webhook')
    ->name('webhook');
});
