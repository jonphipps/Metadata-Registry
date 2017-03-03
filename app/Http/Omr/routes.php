<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'     => config('admin.prefix'),
    'namespace'  => Admin::controllerNamespace(),
    'middleware' => [ 'web' ],
],
    function (Router $router) {
      $router->get('/home', 'HomeController@index');
      $router->resource('/projects', 'ProjectController', [ 'only' => 'index' ]);
      Route::group([ 'middleware' => [ 'admin' ] ],
          function (Router $router) {
            $router->get('/projects/{project}/vocabularies', 'VocabularyController@index');
            $router->get('/projects/{project}/elementsets', 'ElementSetController@index');
            $router->resource('/projects', 'ProjectController', [ 'except' => 'index' ]);
            $router->resource('/vocabularies/{vocabulary}/concepts', 'ConceptController');
            $router->resource('/vocabularies', 'VocabularyController');
            $router->resource('/elementsets/{elementSet}/elements', 'ElementController');
            $router->resource('/elementsets', 'ElementSetController');
            $router->resource('/users', 'UserController');
            $router->get('project_user/{id}',
                'ProjectHasUserController@edit')
                   ->name('project.user.edit');
          });

    });

