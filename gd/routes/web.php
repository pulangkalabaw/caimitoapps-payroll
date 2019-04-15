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
	$router->get('government-deductions', 'GovernmentController@index');
	$router->post('government-deductions/store', 'GovernmentController@store');
	$router->get('government-deductions/{id}', 'GovernmentController@show');
	// $router->get('government-deductions', 'GovernmentController@edit');
	$router->put('government-deductions/{id}', 'GovernmentController@update');
	$router->delete('government-deductions/{id}', 'GovernmentController@destroy');


	//PHILHEALTH GOVERNMENT DEDUCTIONS
	$router->get('philhealth-deductions', 'PhilhealthCobtroller@index');
	$router->post('philhealth-deductions/store', 'PhilhealthCobtroller@store');
	$router->get('philhealth-deductions/{id}', 'PhilhealthCobtroller@show');
	// $router->get('philhealth-deductions', 'PhilhealthCobtroller@edit');
	$router->put('philhealth-deductions/{id}', 'PhilhealthCobtroller@update');
	$router->delete('philhealth-deductions/{id}', 'PhilhealthCobtroller@destroy');

});
