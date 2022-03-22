<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/docs', function () {
    return view('vendor/swagger-lume/index');
});

$router->group(['prefix'=>'api/v1'], function() use($router){

    $router->get('/webhook', [
        'middleware' => 'auth',
        'uses' => 'WebhookController@webhook'
    ]);
    
    $router->get('/message/{id}/{message}', [
        'middleware' => 'auth',
        'uses' => 'MessageSubscribersController@MessageOneSubscribers'
    ]);

    $router->post('/message/all', [
        'middleware' => 'auth',
        'uses' => 'MessageSubscribersController@MessageAllSubscribers'
    ]);

    $router->post('/subscribe', [
        'middleware' => 'auth',
        'uses' => 'ChatSubscriptionController@subscribe'
    ]);

});
