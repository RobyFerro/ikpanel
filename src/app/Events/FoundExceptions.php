<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 04/04/2019
 * Time: 12:48
 */

namespace ikdev\ikpanel\app\Events;


use ikdev\ikpanel\app\Errors;
use Illuminate\Queue\SerializesModels;

class FoundExceptions {
	use SerializesModels;
	
	public $error;
	
	public function __construct(Errors $errors) {
		$this->error = $errors;
	}
}
