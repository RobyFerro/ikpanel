<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 25/03/2019
 * Time: 10:47
 */

namespace ikdev\ikpanel\app;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Errors extends Model {
	use SoftDeletes;
	
	protected $primaryKey = 'id';
	protected $table = 'error_exception_log';
	protected $dates = ['fixed_at', 'first_seen', 'last_seen', 'created_at', 'updated_at'];
	protected $customFormat = "d/m/Y H:i:s";
	protected $casts = [
		'exception' => 'array'
	];
	
	/**
	 * @return BelongsToMany
	 */
	public function comments() {
		return $this->belongsToMany(ErrorsComments::class, 'comment_error', 'exception_id', 'id');
	}
	
	/**
	 * @param $value
	 * @return string
	 */
	public function getCreatedAtAttribute($value) {
		return Carbon::parse($value)->format($this->customFormat);
	}
	
	/**
	 * @param $value
	 * @return string
	 */
	public function getFirstSeenAttribute($value) {
		return Carbon::parse($value)->format($this->customFormat);
	}
	
	/**
	 * @param $value
	 * @return string
	 */
	public function getLastSeenAttribute($value) {
		return Carbon::parse($value)->format($this->customFormat);
	}
	
	/**
	 * @param $value
	 * @return string
	 */
	public function getFixedAtAttribute($value) {
		return Carbon::parse($value)->format($this->customFormat);
	}
	
}
