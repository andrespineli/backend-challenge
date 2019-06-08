<?php

$router->group(['prefix' => 'v1', 'middleware' => ['cors', 'auth:api']], function () use ($router) {

    $router->get('/customers', 'CustomerController@get');  
    $router->post('/products', 'ProductController@new'); 
    $router->get('/orders', 'OrderController@get');
    $router->post('/orders', 'OrderController@new'); 
    $router->put('/orders/{order_id}', 'OrderController@cancel');       

});

$router->group(['prefix' => 'v1', 'middleware' => []], function () use ($router) {         
    
    $router->post('/customers', 'CustomerController@new');
    $router->post('/login', 'AuthController@logIn');
    $router->get('/products', 'ProductController@get');  
    
});