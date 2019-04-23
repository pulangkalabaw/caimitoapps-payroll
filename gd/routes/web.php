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

	//SSS GOVERNMENT DEDUCTIONS
	$router->get('sss-deductions', 'sssController@index');
	$router->post('sss-deductions/store', 'sssController@store');
	$router->get('sss-deductions/{id}', 'sssController@show');
	// $router->get('sss-deductions', 'sssController@edit');
	$router->put('sss-deductions/{id}', 'sssController@update');
	$router->delete('sss-deductions/{id}', 'sssController@destroy');


	//SSS GOVERNMENT DEDUCTIONS
	$router->get('tax-deductions', 'taxController@index');
	$router->post('tax-deductions/store', 'taxController@store');
	$router->get('tax-deductions/{id}', 'taxController@show');
	// $router->get('tax-deductions', 'taxController@edit');
	$router->put('tax-deductions/{id}', 'taxController@update');
	$router->delete('tax-deductions/{id}', 'taxController@destroy');
});
