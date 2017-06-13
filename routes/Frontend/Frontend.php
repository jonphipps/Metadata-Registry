<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');
Route::group([ 'namespace' => 'Project' ],
    function() {
        CRUD::resource('projects', 'ProjectCrudController');

        //Route::get('projects/{project}', 'ProjectController@show')->name('project.show');
    });
        /* ----------------------------------------------------------------------- */
Route::get('projects/{project}/imports/create', 'ImportCrudController@importProject')->name('project.import.create');
Route::get('projects/{project}/import/{step?}', 'ImportCrudController@importProject')->name('project.import');
Route::post('projects/{project}/import/{step}', 'ImportCrudController@processImportProject')->name('project.import.post');
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
