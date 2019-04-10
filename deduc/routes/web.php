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
    // Allowance
    // $router->get('allowance', 'AllowanceController@index');
    // $router->post('allowance','AllowanceController@store');
    // $router->get('allowance/{id}','AllowanceController@show');
    // $router->put('allowance/{id}','AllowanceController@update');
    // $router->delete('allowance/{id}/delete','AllowanceController@destroy');

});
