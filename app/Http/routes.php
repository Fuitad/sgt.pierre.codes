<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$app->get('/', function () use ($app) {
    return view('index');
});

$app->get('/about', ['uses' => 'AboutController@index']);

$app->group([
    'prefix' => '/rest', 'namespace' => 'App\Http\Controllers\Rest',
], function () use ($app) {
    resource('user');
    resource('product');
    resource('order');
    resource('order-item');
});
