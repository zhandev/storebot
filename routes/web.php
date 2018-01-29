<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Shopify')->group(function () {

    Route::prefix('shopify')->group(function () {

        Route::get('/', 'AuthController@install')->name('install');

        Route::get('callback', 'AuthController@callback');

        Route::get('charge-create', 'AuthController@chargeCreate')->name('chargeCreate');

        Route::get('charge-check', 'AuthController@chargeCheck')->name('chargeCheck');

        Route::get('charge-cancel', 'AuthController@chargeCancel')->name('chargeCancel');
    });

});

Route::namespace('Client')->group(function () {

    Route::prefix('client')->group(function () {

        Route::get('/', 'ClientController@index')->name('dashboard');

        Route::get('connect-messenger', 'MessengerController@index')->name('connectMessenger');

        Route::post('update-webhooks', 'ClientController@updateWebhooks')->name('updateWebhooks');
    });

});

Route::namespace('Messenger')->group(function () {

    Route::prefix('messenger')->group(function () {

        Route::get('webhook', 'MessengerController@webhook');

        Route::post('webhook', 'MessengerController@handle');

    });

});

Route::namespace('Messenger')->group(function () {

    Route::prefix('webview')->group(function () {

        Route::get('cart', 'WebViewController@cart')->name('webview-cart');

        Route::get('checkout', 'WebViewController@checkout')->name('webview-checkout');

    });

});

Route::namespace('Shopify')->group(function () {

    Route::prefix('shopify')->group(function () {

        Route::post('webhook', 'WebhookHandleController@handle');

    });

});

/*
 * Develop Side
 */

Route::namespace('Messenger')->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('init', 'SettingsController@init');

    });

});

Route::post('bitbucket/webhooks', function(\Illuminate\Http\Request $request) {

    $payload = json_decode($request->getContent(), true);
    $eventKey = $request->headers->get('X-Event-Key');

    $output = shell_exec('cd /var/www/storebot && git pull 2>&1');

    return response($output, 200);

});