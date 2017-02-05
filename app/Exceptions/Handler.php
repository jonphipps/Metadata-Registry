<?php

namespace App\Exceptions;

use Bugsnag;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Whoops\Handler\PrettyPageHandler;

/**
 * Class Handler
 * @package App\Exceptions
 */
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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (class_exists('Bugsnag' && method_exists('Bugsnag', 'notify_exception'))) {
            Bugsnag::notifyException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        /**
         * Redirect if token mismatch error
         * Usually because user stayed on the same screen too long and their session expired
         */
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('frontend.auth.login');
        }

        /**
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }


  /**
   * Create a Symfony response for the given exception.
   *
   * @param  \Exception $e
   *
   * @return mixed
   */
    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            $whoops = new \Whoops\Run;
            $handler = new PrettyPageHandler();
            //$handler->setEditor('phpstorm');
            $handler->setEditor(function ($file, $line) {
                // if your development server is not local it's good to map remote files to local
                $translations = [ '^' . env('VAGRANT_HOME') => env('LOCAL_HOME') ]; // change to your path
                foreach ($translations as $from => $to) {
                    $file = preg_replace('#' . $from . '#', $to, $file, 1);
                }

                return [
                  'url'  => "phpstorm://open?file=$file&line=$line",
                  'ajax' => false
                ];
            });
            $handler->addResourcePath(base_path('app/Exceptions'));
            $handler->addCustomCss('whoops.base.css');
            $whoops->pushHandler($handler);

            return response()->make(
                $whoops->handleException($e),
                method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
                method_exists($e, 'getHeaders') ? $e->getHeaders() : []
            );
        }

        return parent::convertExceptionToResponse($e);
    }
}
