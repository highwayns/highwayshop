<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('admin')->group(function () {

        // Admin Routes
        Route::group(['middleware' => ['admin']], function () {
            // Merchant Source Routes
            Route::get('/merchant_sources', 'Highwayns\Merchant\Http\Controllers\MerchantSourceController@index')->defaults('_config', [
                'view' => 'admin::settings.merchant_sources.index'
            ])->name('admin.merchant_sources.index');

            Route::get('/merchant_sources/create', 'Highwayns\Merchant\Http\Controllers\MerchantSourceController@create')->defaults('_config', [
                'view' => 'admin::settings.merchant_sources.create'
            ])->name('admin.merchant_sources.create');

            Route::post('/merchant_sources/create', 'Highwayns\Merchant\Http\Controllers\MerchantSourceController@store')->defaults('_config', [
                'redirect' => 'admin.merchant_sources.index'
            ])->name('admin.merchant_sources.store');

            Route::get('/merchant_sources/edit/{id}', 'Highwayns\Merchant\Http\Controllers\MerchantSourceController@edit')->defaults('_config', [
                'view' => 'admin::settings.merchant_sources.edit'
            ])->name('admin.merchant_sources.edit');

            Route::put('/merchant_sources/edit/{id}', 'Highwayns\Merchant\Http\Controllers\MerchantSourceController@update')->defaults('_config', [
                'redirect' => 'admin.merchant_sources.index'
            ])->name('admin.merchant_sources.update');

            Route::post('/merchant_sources/delete/{id}', 'Highwayns\Merchant\Http\Controllers\MerchantSourceController@destroy')->name('admin.merchant_sources.delete');

            Route::post('/merchantconfirm/destroy', 'Highwayns\Merchant\Http\Controllers\MerchantSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'admin.merchant_sources.index'
            ])->name('admin.merchants.confirm.destroy');

            // Merchant Role Routes
            Route::get('/merchantroles', 'Highwayns\Merchant\Http\Controllers\MerchantRoleController@index')->defaults('_config', [
                'view' => 'admin::settings.merchant_roles.index'
            ])->name('admin.merchantroles.index');

            Route::get('/merchantroles/create', 'Highwayns\Merchant\Http\Controllers\MerchantRoleController@create')->defaults('_config', [
                'view' => 'admin::settings.merchant_roles.create'
            ])->name('admin.merchantroles.create');

            Route::post('/merchantroles/create', 'Highwayns\Merchant\Http\Controllers\MerchantRoleController@store')->defaults('_config', [
                'redirect' => 'admin.merchantroles.index'
            ])->name('admin.merchantroles.store');

            Route::get('/merchantroles/edit/{id}', 'Highwayns\Merchant\Http\Controllers\MerchantRoleController@edit')->defaults('_config', [
                'view' => 'admin::settings.merchant_roles.edit'
            ])->name('admin.merchantroles.edit');

            Route::put('/merchantroles/edit/{id}', 'Highwayns\Merchant\Http\Controllers\MerchantRoleController@update')->defaults('_config', [
                'redirect' => 'admin.merchantroles.index'
            ])->name('admin.merchantroles.update');

            Route::post('/merchantroles/delete/{id}', 'Highwayns\Merchant\Http\Controllers\MerchantRoleController@destroy')->name('admin.merchantroles.delete');

        });
    });
});
