<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 25/03/2019
 * Time: 10:47
 */

namespace ikdev\ikpanel\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Errors extends Model {
	use SoftDeletes;
	
	protected $primaryKey = 'id';
	protected $table = 'error_exception_log';
	protected $dates = ['fixed_at', 'first_seen', 'last_seen', 'created_at', 'updated_at'];
	
	public function comments() {
		return $this->belongsToMany(ErrorsComments::class, 'comment_error', 'exception_id', 'id');
	}
	
}
