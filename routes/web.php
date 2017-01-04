<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend
 */
// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */
Route::group([ 'middleware' => 'passthru' ], function () {
  Route::any('vocabularies/{id}/exports/save');
  Route::any('elementsets/{id}/exports/save');
});


/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
	includeRouteFiles(__DIR__ . '/Frontend/');
});

/* ----------------------------------------------------------------------- */

/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
	/**
	 * These routes need view-backend permission
	 * (good if you want to allow more than one group in the backend,
	 * then limit the backend features by different roles or permissions)
	 *
	 * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
	 */
	includeRouteFiles(__DIR__ . '/Backend/');
});

Route::any('{all}',
    function () {
      // fire up symfony
      if (!defined('SF_APP')) {
        define('SF_APP', 'frontend');
        define('SF_ENVIRONMENT', env('SF_ENVIRONMENT', 'prod'));
        define('SF_DEBUG', env('SF_DEBUG', 'false'));
      }
      require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
      //let symfony handle/render the request
      sfContext::getInstance()->getController()->dispatch();
      // return the symfony rendering as the response
      return ob_get_clean();
    })->where('all', '.*');
