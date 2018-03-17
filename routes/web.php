<?php

// user register and auth
$router->post('register/', 'UsersController@register');
$router->post('login/', 'UsersController@authenticate');

// sets
$router->post('sets/', 'SetsController@store');
$router->get('sets/', 'SetsController@index');
$router->get('sets/{id}/', 'SetsController@show');
$router->put('sets/{id}/', 'SetsController@update');
$router->delete('sets/{id}/', 'SetsController@destroy');

// words
$router->post('words/', 'WordsController@store');
$router->get('words/{id}/', 'WordsController@index');
$router->put('words/{id}/', 'WordsController@update');
$router->delete('words/{id}/', 'WordsController@destroy');
