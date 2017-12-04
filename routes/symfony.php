<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-01-08,  Time: 5:39 PM */

use Illuminate\Support\Facades\Route;

Route::group([ 'middleware' => 'symfony'],
    function () {

        Route::group(['middleware' => 'passthru'],
            function () {
                Route::any('vocabularies/{id}/exports/save');
                Route::any('elementsets/{id}/exports/save');
            });

        Route::any('{all}',
            function () {
                // fire up symfony
                if (! defined('SF_APP')) {
                    define('SF_APP', 'frontend');
                    define('SF_ENVIRONMENT', env('SF_ENVIRONMENT', 'prod'));
                    define('SF_DEBUG', env('SF_DEBUG', 'false'));
                }
                if (! defined('SF_ROOT_DIR')) {
                    define('SF_ROOT_DIR', env('SF_ROOT_DIR', app()->basePath()));
                }

                $_SERVER['HTTP_HOST'] = request()->getHost() ;
                $_SERVER['SERVER_NAME'] = empty($_SERVER['SERVER_NAME']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
                $_SERVER['SERVER_PORT'] = empty($_SERVER['SERVER_PORT']) ? 80 : $_SERVER['SERVER_PORT'];
                $_SERVER['HTTP_USER_AGENT'] = empty($_SERVER['HTTP_USER_AGENT']) ? 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36' : $_SERVER['HTTP_USER_AGENT'];
                $_SERVER['REMOTE_ADDR'] = empty($_SERVER['REMOTE_ADDR']) ? '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
                $_SERVER['REQUEST_METHOD'] = strtoupper(request()->getMethod()) ;
                $_SERVER['PATH_INFO'] = request()->getPathInfo() ;
                $_SERVER['REQUEST_URI'] = request()->getUri() ;
                $_SERVER['SCRIPT_NAME'] = empty($_SERVER['SCRIPT_NAME']) ? '/index.php' : $_SERVER['SCRIPT_NAME'];
                $_SERVER['SCRIPT_FILENAME'] = empty($_SERVER['SCRIPT_FILENAME']) ? app()->basePath() . '/web/index.php' : $_SERVER['SCRIPT_FILENAME'];
                $_SERVER['QUERY_STRING'] = request()->getQueryString() ;

                require_once SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

                //set the xmlrequest header for rdf files (this toggles things that check for non-html returns, like Tracy)
                if (ends_with(request()->getRequestUri(), '.rdf')) {
                    request()->headers->set('X-Requested-With', 'XMLHttpRequest');
                }

                    //make sure we have a fresh instance since it's never an internal symfony forward
                if (sfContext::hasInstance()) {
                  sfContext::removeInstance();
                }
                //let symfony handle/render the request
                sfContext::getInstance()->getController()->dispatch();

                // return the symfony rendering as the response
                $html = ob_get_clean();

                return $html === false ? '' :$html;
            })->where('all', '.*');
    });
