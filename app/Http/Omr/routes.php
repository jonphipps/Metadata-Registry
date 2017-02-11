<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'     => config('admin.prefix'),
    'namespace'  => Admin::controllerNamespace(),
    'middleware' => [ 'web', 'admin' ],
],
    function (Router $router) {

      $router->get('/', 'HomeController@index');
      $router->resource('/users', 'UserController');
      $router->resource('/projects', 'ProjectController');
      $router->resource('/vocabularies', 'VocabularyController');

    });
