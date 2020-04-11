<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('admin')->group(function () {

        // Admin Routes
        Route::group(['middleware' => ['admin']], function () {
            // Vendor Source Routes
            Route::get('/vendor_sources', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@index')->defaults('_config', [
                'view' => 'admin::settings.vendor_sources.index'
            ])->name('admin.vendor_sources.index');

            Route::get('/vendor_sources/create', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@create')->defaults('_config', [
                'view' => 'admin::settings.vendor_sources.create'
            ])->name('admin.vendor_sources.create');

            Route::post('/vendor_sources/create', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@store')->defaults('_config', [
                'redirect' => 'admin.vendor_sources.index'
            ])->name('admin.vendor_sources.store');

            Route::get('/vendor_sources/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@edit')->defaults('_config', [
                'view' => 'admin::settings.vendor_sources.edit'
            ])->name('admin.vendor_sources.edit');

            Route::put('/vendor_sources/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@update')->defaults('_config', [
                'redirect' => 'admin.vendor_sources.index'
            ])->name('admin.vendor_sources.update');

            Route::post('/vendor_sources/delete/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@destroy')->name('admin.vendor_sources.delete');

            Route::post('/vendorconfirm/destroy', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'admin.vendor_sources.index'
            ])->name('admin.vendors.confirm.destroy');

            // Vendor Role Routes
            Route::get('/vendorroles', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@index')->defaults('_config', [
                'view' => 'admin::settings.vendor_roles.index'
            ])->name('admin.vendorroles.index');

            Route::get('/vendorroles/create', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@create')->defaults('_config', [
                'view' => 'admin::settings.vendor_roles.create'
            ])->name('admin.vendorroles.create');

            Route::post('/vendorroles/create', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@store')->defaults('_config', [
                'redirect' => 'admin.vendorroles.index'
            ])->name('admin.vendorroles.store');

            Route::get('/vendorroles/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@edit')->defaults('_config', [
                'view' => 'admin::settings.vendor_roles.edit'
            ])->name('admin.vendorroles.edit');

            Route::put('/vendorroles/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@update')->defaults('_config', [
                'redirect' => 'admin.vendorroles.index'
            ])->name('admin.vendorroles.update');

            Route::post('/vendorroles/delete/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@destroy')->name('admin.vendorroles.delete');
        });
    });
});
