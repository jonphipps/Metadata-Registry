<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use sfContext;

class PassThrough
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // fire up symfony
        if (! defined('SF_APP')) {
            define('SF_APP', 'frontend');
            define('SF_ENVIRONMENT', env('SF_ENVIRONMENT', 'prod'));
            define('SF_DEBUG', env('SF_DEBUG', 'false'));
        }
        if (! defined('SF_ROOT_DIR')) {
            define('SF_ROOT_DIR', env('SF_ROOT_DIR'));
        }

        $_SERVER['HTTP_HOST']       = (empty($_SERVER['HTTP_HOST'])) ? $request->getHost() : $_SERVER['HTTP_HOST'];
        $_SERVER['SERVER_NAME']     = (empty($_SERVER['SERVER_NAME'])) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        $_SERVER['SERVER_PORT']     = (empty($_SERVER['SERVER_PORT'])) ? 80 : $_SERVER['SERVER_PORT'];
        $_SERVER['HTTP_USER_AGENT'] = (empty($_SERVER['HTTP_USER_AGENT'])) ? 'PHP5/CLI' : $_SERVER['HTTP_USER_AGENT'];
        $_SERVER['REMOTE_ADDR']     = (empty($_SERVER['REMOTE_ADDR'])) ? '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
        $_SERVER['REQUEST_METHOD']  = (empty($_SERVER['REQUEST_METHOD'])) ? strtoupper($request->getMethod()) : $_SERVER['REQUEST_METHOD'];
        $_SERVER['PATH_INFO']       = (empty($_SERVER['PATH_INFO'])) ? $request->getPathInfo() : $_SERVER['PATH_INFO'];
        $_SERVER['REQUEST_URI']     = (empty($_SERVER['REQUEST_URI'])) ? $request->getUri() : $_SERVER['REQUEST_URI'];
        $_SERVER['SCRIPT_NAME']     = (empty($_SERVER['SCRIPT_NAME'])) ? '/index.php' : $_SERVER['SCRIPT_NAME'];
        $_SERVER['SCRIPT_FILENAME'] = (empty($_SERVER['SCRIPT_FILENAME'])) ? '/index.php' : $_SERVER['SCRIPT_FILENAME'];
        $_SERVER['QUERY_STRING']    = (empty($_SERVER['QUERY_STRING'])) ? $request->getQueryString() : $_SERVER['QUERY_STRING'];
        require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        //let symfony handle/render the request

        /** @var \sfWebResponse $symfonyResponse */
        $symfonyResponse = sfContext::getInstance()->getController()->dispatch();
        //throw away the symfony rendered buffer
        while (ob_get_level()) {
            ob_end_clean();
        }

        //make a new laravel response object and assign the content generated from symfony
        return new Response($symfonyResponse->getContent());
    }
}
