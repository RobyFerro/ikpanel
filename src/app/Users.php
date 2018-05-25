<?php
/**
 * Created by PhpStorm.
 * User: roberto.ferro
 * Date: 27/04/2018
 * Time: 21:17
 */

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Users
 * @package ecit\admin_panel\app
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
 * @property Role $user_role
 */
class Users extends Authenticatable {
	use SoftDeletes;
	
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $hidden = ['password', 'remember_token'];
	
	public function user_role() {
		return $this->belongsTo(Role::class, 'role', 'id');
	}

	public function hasToken($token){
	    return in_array($token, $this->user_role->token()->pluck('id')->toArray());
    }
}