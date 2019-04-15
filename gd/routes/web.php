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

    //SSS GOVERNMENT DEDUCTION
	$router->get('government-deductions', 'GovernmentController@index');
	$router->post('government-deductions/store', 'GovernmentController@store');
	$router->get('government-deductions/{id}', 'GovernmentController@show');
	// $router->get('government-deductions', 'GovernmentController@edit');
	$router->put('government-deductions/{id}', 'GovernmentController@update');
	$router->delete('government-deductions/{id}', 'GovernmentController@destroy');

});