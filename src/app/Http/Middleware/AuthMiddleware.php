<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Http\Middleware;

use Closure;
use ikdev\ikpanel\app\RouteGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthMiddleware
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

        $mod_route_group = new RouteGroup();
        if(!Auth::check()){
            return redirect(env('IKPANEL_URL').'/login');
        } // if
	
	    /*try {
			$route_details = $mod_route_group->where('name','=', Route::current()->getName())
				->first();
		} catch (QueryException $e) {
			throw $e;
		} // try

		if(!is_null($route_details)){

			if(!Auth::user()->hasToken($route_details->id_token)){
				return redirect(env('IKPANEL_URL'));
			} // if

		} // if*/

        return $next($request);
    }
}
