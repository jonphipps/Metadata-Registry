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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      //fire up symfony
      require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

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
