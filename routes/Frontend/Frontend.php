<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');
CRUD::resource('projects', 'ProjectCrudController', [ 'except' => [ 'show' ] ])->with(function() {
    // add extra routes to this resource
    Route::get('projects/{project}/{type}/{step?}', 'ProjectImportController@importStep')->name('project.import');
    Route::post('projects/{project}/{id}/{step?}', 'ProjectImportController@processImportStep')->name('project.import.process');
});
Route::group([],
    function() {
        // Flow controller
        Route::get('flows/{id}/{step?}', [ 'as' => 'flows.step', 'uses' => '\Ixudra\Wizard\Http\Controllers\FlowController@step' ]);
        Route::post('flows/{id}/{step?}', [ 'as' => 'flows.step.process', 'uses' => '\Ixudra\Wizard\Http\Controllers\FlowController@processStep' ]);
    });
/* ----------------------------------------------------------------------- */

Route::get('projects/{project}', 'ProjectController@show')->name('project.show');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group([ 'middleware' => 'auth' ],
    function() {
        Route::group([ 'namespace' => 'User', 'as' => 'user.' ],
            function() {
                /*
                 * User Dashboard Specific
                 */
                Route::get('dashboard', 'DashboardController@index')->name('dashboard');

                /*
                 * User Account Specific
                 */
                Route::get('account', 'AccountController@index')->name('account');

                /*
                 * User Profile Specific
                 */
                Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
            });
    });
