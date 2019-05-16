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
$router->get('sample/index', 'SamplesController@computation');
$router->get('sample/pis-timekeeping', 'SamplesController@pis_timekeeping');
 
$router->group(['middleware' => ['cors']], function() use ($router){
    $router->get('sss-government-deduction', 'SamplesController@getGovernmentSSSDeduction');

    //SSS GOVERNMENT DEDUCTIONS
    $router->get('sss-deductions', 'SssController@index');
    $router->post('sss-deductions/store', 'SssController@store');
    $router->get('sss-deductions/{id}', 'SssController@show');
    // $router->get('sss-deductions', 'SssController@edit');
    $router->put('sss-deductions/{id}', 'SssController@update');
    $router->delete('sss-deductions/{id}', 'SssController@destroy');

    //TAX GOVERNMENT DEDUCTIONS
    $router->get('tax-deductions', 'TaxController@index');
    $router->post('tax-deductions/store', 'TaxController@store');
    $router->get('tax-deductions/{id}', 'TaxController@show');
    // $router->get('tax-deductions', 'TaxController@edit');
    $router->put('tax-deductions/{id}', 'TaxController@update');
    $router->delete('tax-deductions/{id}', 'TaxController@destroy');
});
