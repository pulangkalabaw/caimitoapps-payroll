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
 * Routes for resource sample
 */
$router->get('sample/index', 'SamplesController@index');
// $router->get('sample', 'SamplesController@all');
// $router->get('sample/{id}', 'SamplesController@get');
// $router->post('sample', 'SamplesController@add');
// $router->put('sample/{id}', 'SamplesController@put');
// $router->delete('sample/{id}', 'SamplesController@remove');
