<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 20/03/2019
 * Time: 19:04
 */

namespace ikdev\ikpanel\app\Classes\Exception;

use Carbon\Carbon;
use ikdev\ikpanel\app\Errors;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ExceptionReporting {
	
	/**
	 * @param $exception
	 * @param $type
	 * @return int
	 */
	public function report($exception, $type) {
		
		try {
			$id = Errors::insertGetId([
				"type"       => $type,
				"guilty_id"  => Auth::id(),
				"ip"         => Request::ip(),
				"user_agent" => Request::userAgent(),
				"exception"  => json_encode($exception),
				"created_at" => Carbon::now()
			]);
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return $id;
		
	}
	
}
