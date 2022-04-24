<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('Japayment/AuPayment')->group(function () {

        Route::get('/redirect', 'Highwayns\JaPayment\Http\Controllers\AuPaymentController@redirect')->name('Japayment.AuPayment.redirect');

        Route::get('/success', 'Highwayns\JaPayment\Http\Controllers\AuPaymentController@success')->name('Japayment.AuPayment.success');

        Route::get('/cancel', 'Highwayns\JaPayment\Http\Controllers\AuPaymentController@cancel')->name('Japayment.AuPayment.cancel');
    });
    Route::prefix('Japayment/DocomoPayment')->group(function () {

        Route::get('/redirect', 'Highwayns\JaPayment\Http\Controllers\DocomoPaymentController@redirect')->name('Japayment.DocomoPayment.redirect');

        Route::get('/success', 'Highwayns\JaPayment\Http\Controllers\DocomoPaymentController@success')->name('Japayment.DocomoPayment.success');

        Route::get('/cancel', 'Highwayns\JaPayment\Http\Controllers\DocomoPaymentController@cancel')->name('Japayment.DocomoPayment.cancel');
    });
    Route::prefix('Japayment/SoftbankPayment')->group(function () {

        Route::get('/redirect', 'Highwayns\JaPayment\Http\Controllers\SoftbankPaymentController@redirect')->name('Japayment.SoftbankPayment.redirect');

        Route::get('/success', 'Highwayns\JaPayment\Http\Controllers\SoftbankPaymentController@success')->name('Japayment.SoftbankPayment.success');

        Route::get('/cancel', 'Highwayns\JaPayment\Http\Controllers\SoftbankPaymentController@cancel')->name('Japayment.SoftbankPayment.cancel');
    });
});
Route::get('Japayment/AuPayment/ipn', 'Highwayns\JaPayment\Http\Controllers\AuPaymentController@ipn')->name('Japayment.AuPayment.ipn');

Route::get('Japayment/DocomoPayment/ipn', 'Highwayns\JaPayment\Http\Controllers\DocomoPaymentController@ipn')->name('Japayment.DocomoPayment.ipn');

Route::get('Japayment/SoftbankPayment/ipn', 'Highwayns\JaPayment\Http\Controllers\SoftbankPaymentController@ipn')->name('Japayment.SoftbankPayment.ipn');
