<?php

//use Illuminate\Http\Request;

$router->group(['prefix' => 'v1', 'middleware' => ['cors', 'auth:api']], function () use ($router) {

	$router->post('/rewards', 'RewardController@create');               

});

$router->group(['prefix' => 'v1', 'middleware' => []], function () use ($router) {         
    
      $router->post('accounts/signin', 'AccountController@signin');
    
});