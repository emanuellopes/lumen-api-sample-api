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
    return array(
        'version' => $router->app->version(),
    );
});

$router->group(['prefix' => 'authors'], function () use ($router) {
    $router->get('/', 'Author@all');
    $router->post('/', 'Author@create');
    $router->get('/{id:\d+}', 'Author@getSingleAuthor');
    $router->put('/{id:\d+}', 'Author@update');
    $router->patch('/{id:\d+}', 'Author@update');
    $router->delete('/{id:\d+}', 'Author@destroy');
});
