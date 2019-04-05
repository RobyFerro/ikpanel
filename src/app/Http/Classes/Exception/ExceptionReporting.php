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
use ikdev\ikpanel\app\Events\FoundExceptions;
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
			$error = new Errors();
			$error->type = $type;
			$error->guilty_id = Auth::id();
			$error->ip = Request::ip();
			$error->user_agent = Request::userAgent();
			$error->exception = json_encode($exception);
			$error->save();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		return $error->id;
		
	}
	
}
