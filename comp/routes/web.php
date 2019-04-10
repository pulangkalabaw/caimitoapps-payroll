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
    
    // Compensation
    $router->get('compensation', 'CompensationController@index');
    $router->post('compensation','CompensationController@store');
    $router->get('compensation/{id}','CompensationController@show');
    $router->put('compensation/{id}','CompensationController@update');
    $router->delete('compensation/{id}/delete','CompensationController@destroy');


    // User Allowance

    $router->get('user_compensation', 'UserCompensationController@index');
    $router->post('user_compensation', 'UserCompensationController@store');
    $router->get('user_compensation/{id}', 'UserCompensationController@show');
    $router->put('user_compensation/{id}', 'UserCompensationController@update');


    // Deduction
    $router->post('deduction','DeductionController@store');

});
