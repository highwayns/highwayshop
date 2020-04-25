<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('Japayment/AuPayment')->group(function () {

        Route::get('/redirect', 'Highwayns\JaPament\Http\Controllers\AuPaymentController@redirect')->name('Japayment.AuPayment.redirect');

        Route::get('/success', 'Highwayns\JaPament\Http\Controllers\AuPaymentController@success')->name('Japayment.AuPayment.success');

        Route::get('/cancel', 'Highwayns\JaPament\Http\Controllers\AuPaymentController@cancel')->name('Japayment.AuPayment.cancel');
    });
    Route::prefix('Japayment/DocomoPayment')->group(function () {

        Route::get('/redirect', 'Highwayns\JaPament\Http\Controllers\DocomoPaymentController@redirect')->name('Japayment.DocomoPayment.redirect');

        Route::get('/success', 'Highwayns\JaPament\Http\Controllers\DocomoPaymentController@success')->name('Japayment.DocomoPayment.success');

        Route::get('/cancel', 'Highwayns\JaPament\Http\Controllers\DocomoPaymentController@cancel')->name('Japayment.DocomoPayment.cancel');
    });
    Route::prefix('Japayment/SoftbankPayment')->group(function () {

        Route::get('/redirect', 'Highwayns\JaPament\Http\Controllers\SoftbankPaymentController@redirect')->name('Japayment.SoftbankPayment.redirect');

        Route::get('/success', 'Highwayns\JaPament\Http\Controllers\SoftbankPaymentController@success')->name('Japayment.SoftbankPayment.success');

        Route::get('/cancel', 'Highwayns\JaPament\Http\Controllers\SoftbankPaymentController@cancel')->name('Japayment.SoftbankPayment.cancel');
    });
});
Route::get('Japayment/AuPayment/ipn', 'Highwayns\JaPament\Http\Controllers\AuPaymentController@ipn')->name('Japayment.AuPayment.ipn');

Route::post('Japayment/AuPayment/ipn', 'Highwayns\JaPament\Http\Controllers\AuPaymentController@ipn')->name('Japayment.AuPayment.ipn');

Route::get('Japayment/DocomoPayment/ipn', 'Highwayns\JaPament\Http\Controllers\DocomoPaymentController@ipn')->name('Japayment.DocomoPayment.ipn');

Route::post('Japayment/DocomoPayment/ipn', 'Highwayns\JaPament\Http\Controllers\DocomoPaymentController@ipn')->name('Japayment.DocomoPayment.ipn');

Route::get('Japayment/SoftbankPayment/ipn', 'Highwayns\JaPament\Http\Controllers\SoftbankPaymentController@ipn')->name('Japayment.SoftbankPayment.ipn');

Route::post('Japayment/SoftbankPayment/ipn', 'Highwayns\JaPament\Http\Controllers\SoftbankPaymentController@ipn')->name('Japayment.SoftbankPayment.ipn');
