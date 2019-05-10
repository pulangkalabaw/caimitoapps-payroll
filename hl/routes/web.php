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

$router->group(['middleware' => ['cors']], function() use ($router)
{

    // Leave Management
    $router->get('leave', 'LeaveController@index');
    $router->post('leave', 'LeaveController@store');
    $router->get('leave/{leave_id}', 'LeaveController@show');
    $router->put('leave/{leave_id}', 'LeaveController@update');
    $router->delete('leave/{leave_id}', 'LeaveController@destroy');

    // Leave Credits
    $router->get('leave_credit', 'LeaveCreditController@index');
    $router->post('leave_credit', 'LeaveCreditController@store');
    $router->get('leave_credit/{user_id}', 'LeaveCreditController@show');
    $router->put('leave_credit/{id}', 'LeaveCreditController@update');

    // Leave Credit Audit
    $router->get('leave_credit_audit', 'LeaveCreditAuditController@index');
    $router->post('leave_credit_audit', 'LeaveCreditAuditController@store');
    $router->get('leave_credit_audit/{id}', 'LeaveCreditAuditController@show');

});
