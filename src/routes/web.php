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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * asdasdasd
 */
$router->group([
    'prefix' => 'api',
    'middleware' => 'guard'
], function () use ($router) {
    $router->get('participants[/event/{id}]', [
        'uses' => 'ParticipantsController@actionList',
    ]);

    $router->post('participants', [
        'uses' => 'ParticipantsController@actionCreate',
    ]);

    $router->get('participants/{id}', [
        'uses' => 'ParticipantsController@actionView',
    ]);

    $router->put('participants/{id}', [
        'uses' => 'ParticipantsController@actionUpdate',
    ]);

    $router->delete('participants/{id}', [
        'uses' => 'ParticipantsController@actionDelete',
    ]);
});
