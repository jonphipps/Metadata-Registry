<?php

namespace App\Http\Middleware;

use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;

class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        if (auth()->check() && config('admin.operation_log') && auth()->user()->is_administrator) {
            $log = [
                'user_id' => auth()->id(),
                'path'    => $request->path(),
                'method'  => $request->method(),
                'ip'      => $request->getClientIp(),
                'input'   => json_encode($request->input()),
            ];

            \Encore\Admin\Auth\Database\OperationLog::create($log);
        }

        return $next($request);
    }
}
