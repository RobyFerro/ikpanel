<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

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
