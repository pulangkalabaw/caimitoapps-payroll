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

	//TAX GOVERNMENT DEDUCTIONS
	$router->get('gov-tax-deductions', 'TaxController@index');
	$router->post('gov-tax-deductions/store', 'TaxController@store');
	$router->get('gov-tax-deductions/{id}', 'TaxController@show');
	// $router->get('gov-tax-deductions', 'TaxController@edit');
	$router->put('gov-tax-deductions/{id}', 'TaxController@update');
	$router->delete('gov-tax-deductions/{id}', 'TaxController@destroy');

	//TAX GOVERNMENT DEDUCTIONS
	$router->get('gov-loan', 'LoanController@index');
	$router->post('gov-loan/store', 'LoanController@store');
	$router->get('gov-loan/{id}', 'LoanController@show');
	// $router->get('gov-tax-deductions', 'LoanController@edit');
	$router->put('gov-loan/{id}', 'LoanController@update');
	$router->delete('gov-loan/{id}', 'LoanController@destroy');

});
