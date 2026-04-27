<?php

/*
|--------------------------------------------------------------------------
| Web Routes - Embeddedlogin Module
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => ['web', 'auth', 'impersonate'],
    'namespace' => 'Modules\Embeddedlogin\Http\Controllers',
    'prefix' => 'embeddedlogin',
], function () {
    Route::post('/callback', 'EmbeddedloginController@handleCallback')->name('embeddedlogin.callback');
});
