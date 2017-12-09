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

                //set the global server headers that symfony needs
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

                //set the xmlrequest header for rdf files (this toggles things that check for non-html returns, like Tracy)
                if (ends_with(request()->getRequestUri(), '.rdf')) {
                    request()->headers->set('X-Requested-With', 'XMLHttpRequest');
                }

                // fire up symfony
                $sfInstance = getSymfonyApp();

                //let symfony handle/render the request
                $sfInstance->getController()->dispatch();

                // return the symfony rendering as the response
                $html = ob_get_clean();

                return $html === false ? '' :$html;
            })->where('all', '.*');
    });
