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
 * Class Users
 * @package ikdev\ikpanel\app\
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property int $role
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Users extends Model {
	use SoftDeletes;
	
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $hidden = ['password', 'remember_token'];
	
	public function user_role() {
		return $this->belongsTo(Role::class, 'role', 'id');
	}
}