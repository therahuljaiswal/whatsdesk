<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['web', 'auth', 'impersonate'],
    'namespace' => 'Modules\RazorpaySubscribe\Http\Controllers',
    'prefix' => 'razorpaysubscribe',
], function () {
    Route::post('/create-order', 'Main@createOrder')->name('razorpaysubscribe.create_order');
    Route::post('/callback', 'Main@callback')->name('razorpaysubscribe.callback');
});
