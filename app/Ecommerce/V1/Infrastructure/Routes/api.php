<?php

//use Illuminate\Http\Request;

$router->group(['prefix' => 'v1', 'middleware' => ['cors', 'auth:api']], function () use ($router) {

	$router->get('/customers', 'CustomerController@get');            

});

$router->group(['prefix' => 'v1', 'middleware' => []], function () use ($router) {         
    
    $router->post('/customers', 'CustomerController@new');
    $router->post('/login', 'CustomerController@logIn');
    
});