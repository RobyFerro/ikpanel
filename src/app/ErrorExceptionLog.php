<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 21/03/2019
 * Time: 10:21
 */

namespace ikdev\ikpanel\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErrorExceptionLog extends Model {
	use SoftDeletes;
	
	protected $table = 'error_exception_log';
	protected $primaryKey = 'id';
	protected $dates = ['fixed_at', 'created_at', 'updated_at'];
	
}
