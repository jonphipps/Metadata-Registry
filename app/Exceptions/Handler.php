<?php

namespace App\Exceptions;

use Backpack\CRUD\Exception\AccessDeniedException;
use Bugsnag;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Whoops\Handler\PrettyPageHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if (class_exists(Bugsnag::class) && method_exists(Bugsnag::class, 'notify_exception')) {
            Bugsnag::notifyException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        /*
         * Redirect if token mismatch error
         * Usually because user stayed on the same screen too long and their session expired
         */
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('frontend.auth.login');
        }
        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException ||
            $exception instanceof AccessDeniedException) {
            //todo: do something different for logged in user without sufficient credentials and not-logged-in user
            if (request()->project) {
                return redirect()
                    ->route('frontend.crud.projects.show', [ request()->project ])
                    ->withFlashDanger(trans('backpack::crud.unauthorized_access'));
            }
            if (request()->project_id) {
                return redirect()
                    ->route('frontend.crud.projects.show', [ request()->project_id ])
                    ->withFlashDanger(trans('backpack::crud.unauthorized_access'));
            }

            return redirect()->route(homeRoute())->withFlashDanger(trans('backpack::crud.unauthorized_access'));
        }

        /*
         * All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
         */
        if ($exception instanceof GeneralException) {
            return redirect()->back()->withInput()->withFlashDanger($exception->getMessage());
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request                 $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('frontend.auth.login'));
    }

    /**
     * @return mixed|\Whoops\Handler\Handler
     * @throws \InvalidArgumentException
     */
    protected function whoopsHandler()
    {
        return tap(new PrettyPageHandler,
            function(PrettyPageHandler $handler) {
                $files = new Filesystem;
                $handler->setEditor('phpstorm');
                $handler->handleUnconditionally(true);
                $handler->setApplicationPaths(array_flip(Arr::except(array_flip($files->directories(base_path())),
                        [ base_path('vendor') ])));
            });
    }
}
