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

$router->group(['middleware' => ['cors']], function() use ($router){
    // Deduction
    $router->get('deduction','DeductionController@index');
    $router->post('deduction','DeductionController@store');
    $router->get('deduction/{id}','DeductionController@show');
    $router->put('deduction/{id}','DeductionController@update');
    $router->delete('deduction/{id}/delete','DeductionController@destroy');
});
