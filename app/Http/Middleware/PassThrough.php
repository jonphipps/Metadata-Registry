<?php

namespace App\Http\Middleware;

use Closure;

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
         return response("symfony", 418);
    }
}
