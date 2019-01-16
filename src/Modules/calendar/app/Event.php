<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 16/01/2019
 * Time: 18:25
 */

namespace ikdev\ikpanel\Modules\calendar\app;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {
	
	use SoftDeletes;
	
	protected $table = 'events';
	protected $primaryKey = 'id';
	protected $dates = ['start', 'end', 'created_at', 'updated_at', 'deleted_at'];
	
	
}
