<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\app\Http\Middleware;


use Closure;
use ikdev\ikpanel\App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;

class NotificationMiddleware
{
    
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if ($request->exists('notification')) {
            NotificationController::setRead($request->get('id'));
        } // if
        
        return $next($request);
    }
}
