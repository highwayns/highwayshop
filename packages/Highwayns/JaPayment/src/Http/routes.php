<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('paypal/standard')->group(function () {

        Route::get('/redirect', 'Highwayns\JaPament\Http\Controllers\StandardController@redirect')->name('paypal.standard.redirect');

        Route::get('/success', 'Highwayns\JaPament\Http\Controllers\StandardController@success')->name('paypal.standard.success');

        Route::get('/cancel', 'Highwayns\JaPament\Http\Controllers\StandardController@cancel')->name('paypal.standard.cancel');
    });
});

Route::get('paypal/standard/ipn', 'Highwayns\JaPament\Http\Controllers\StandardController@ipn')->name('paypal.standard.ipn');

Route::post('paypal/standard/ipn', 'Highwayns\JaPament\Http\Controllers\StandardController@ipn')->name('paypal.standard.ipn');
