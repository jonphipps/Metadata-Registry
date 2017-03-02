<?php

namespace App\Http\Middleware;

use Closure;

class PreventBackHistory
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
    $response = $next($request);
    if (str_contains($request->url(), 'logout')) {
      return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
                      ->header('Cache-Control', 'post-check=0, pre-check=0', false)
                      ->header('Pragma', 'no-cache')
                      ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }

    return $response;
  }
}
