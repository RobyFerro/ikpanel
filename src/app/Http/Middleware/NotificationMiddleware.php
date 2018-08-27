<?php

namespace ikdev\ikpanel\app\Http\Middleware;


use ikdev\ikpanel\App\Http\Controllers\NotificationController;
use Closure;

class NotificationMiddleware {
	
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		
		if ($request->exists('notification')) {
			NotificationController::setRead($request->get('id'));
		} // if
		
		return $next($request);
	}
}