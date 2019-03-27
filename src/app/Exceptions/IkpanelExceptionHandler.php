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
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class IkpanelExceptionHandler extends ExceptionHandler {
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
	 * @param  \Exception $exception
	 * @return void
	 * @throws Exception
	 */
	public function report(Exception $exception) {
		PanelException::report($exception, 'back');
		parent::report($exception);
	}
	
	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception) {
		if ($exception instanceof NotFoundHttpException) {
			return response()->view('errors.404', [], 404);
		} elseif ($exception instanceof AuthorizationException) {
			return response()->view('ikpanel::errors.403');
		} // if
		
		return parent::render($request, $exception);
	}
	
	/**
	 * Convert an authentication exception into an unauthenticated response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param AuthenticationException $exception
	 * @return \Illuminate\Http\Response
	 */
	protected function unauthenticated($request, AuthenticationException $exception) {
		if ($request->expectsJson()) {
			return response()->json(['error' => 'Unauthenticated.'], 401);
		}
		return redirect()->guest('login');
	}
}
