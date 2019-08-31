<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 26/03/2019
 * Time: 09:52
 */

namespace ikdev\ikpanel\app\Exception;

use Exception;
use ikdev\ikpanel\app\Facades\PanelException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class IkpanelExceptionHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];
    
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  Exception  $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            PanelException::report($exception, 'back');
        }
        parent::report($exception);
    }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param  Exception  $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('ikpanel::errors.404-error');
        } elseif ($exception instanceof AuthorizationException) {
            return response()->view('ikpanel::errors.403-error');
        } // if
        
        return parent::render($request, $exception);
    }
    
    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  Request  $request
     * @param  AuthenticationException  $exception
     * @return Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return redirect()->guest('login');
    }
}
