<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 20/03/2019
 * Time: 19:04
 */

namespace ikdev\ikpanel\app\Classes\Exception;

use Carbon\Carbon;
use ikdev\ikpanel\app\ErrorExceptionLog;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ExceptionReporting {
	
	/**
	 * @param $exception
	 * @param $type
	 * @return int
	 */
	public function report($exception, $type) {
		
		try {
			$id = ErrorExceptionLog::insertGetId([
				"type"       => $type,
				"guilty_id"  => Auth::id(),
				"exception"  => json_encode($exception),
				"created_at" => Carbon::now()
			]);
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return $id;
		
	}
	
}
