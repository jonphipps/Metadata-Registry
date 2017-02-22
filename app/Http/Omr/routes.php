<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'     => config('admin.prefix'),
    'namespace'  => Admin::controllerNamespace(),
    'middleware' => [ 'web'],
],
    function (Router $router) {

      $router->get('/', 'HomeController@index');
      $router->resource('/projects', 'ProjectController');
      $router->resource('/vocabularies', 'VocabularyController');

        Route::group([
            'middleware' => ['admin'],
        ],
            function (Router $router) {
                $router->resource('/users', 'UserController');
                $router->resource('projects',
                    'ProjectController',
                    [
                        'except' => [
                            'index',
                            'show',
                        ],
                    ]);
                $router->get('project_user/{id}',
                    'ProjectHasUserController@edit')->name('project.user.edit');
            });

    });

