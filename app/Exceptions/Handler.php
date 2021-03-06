<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;
use InvalidArgumentException;
use Swift_RfcComplianceException;

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

        if ($request->wantsJson() && $exception instanceof ModelNotFoundException) {
            return response()->json(['status' => 'error', 'message' => 'object requested not found', 'code' => 404], 404);
        }

        if ($request->wantsJson() && $exception instanceof NotFoundHttpException) {
            return response()->json(['status' => 'error', 'message' => 'not found', 'code' => 404], 404);
        }

        if ($request->wantsJson() && $exception instanceof AuthenticationException) {
            return response()->json(['status' => 'error', 'message' => 'unauthenticated', 'code' => 401], 401);
        }

        if ($request->wantsJson() && $exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['status' => 'error', 'message' => 'method not allowed', 'code' => 405], 405);
        }

        if ($request->wantsJson() && $exception instanceof QueryException) {
            return response()->json(['status' => 'error', 'message' => 'unprocessable entity', 'request' => $request, 'exception' => $exception, 'code' => 422], 422);
        }

        if ($request->wantsJson() && $exception instanceof InvalidArgumentException) {
            return response()->json(['status' => 'error', 'message' => 'invalid argument exception ( departureTime )', 'code' => 422], 422);
        }

        if ($request->wantsJson() && $exception instanceof Swift_RfcComplianceException) {
            return response()->json(['status' => 'error', 'message' => 'Address in mailbox given does not comply with RFC 2822, 3.6.2.', 'code' => 422], 422);
        }

        //dd(get_class($exception));

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

        return redirect()->guest(route('login'));
    }
}
