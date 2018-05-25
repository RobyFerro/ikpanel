<?php
/**
 * Created by PhpStorm.
 * User: roberto.ferro
 * Date: 27/04/2018
 * Time: 21:17
 */

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package ecit\admin_panel\app
 * @property int $id
 * @property string $group_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Role extends Model {
	use SoftDeletes;
	
	protected $table = 'role';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	
	public function user() {
		return $this->hasMany(Users::class, 'role', 'id');
	}
	
	public function token() {
		return $this->belongsToMany(Token::class, 'token_role', 'roleid','tokenid');
	}
}