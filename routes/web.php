<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'authors'], function () use ($router) {
    $router->get('/', 'Author@index');
    $router->post('/', 'Author@store');
    $router->get('/{id}', 'Author@show');
    $router->put('/{id}', 'Author@update');
    $router->patch('/{id}', 'Author@update');
    $router->delete('/{id}', 'Author@destroy');
});
