<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

/**
 * Created By Interactive Knowledge Development
 * User: roberto.ferro
 * Date: 27/04/2018
 * Time: 21:17
 */

namespace ikdev\ikpanel\app;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Users
 * @package ikdev\ikpanel\app
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property int $role
 * @property boolean $report_exceptions
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property Role $user_role
 */
class Users extends Authenticatable {
	use SoftDeletes;
	use Notifiable;
	
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $hidden = ['password', 'remember_token'];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user_role() {
		return $this->belongsTo(Role::class, 'role', 'id');
	}
	
	/**
	 * @param $token
	 * @return bool
	 */
	public function hasToken($token) {
		return in_array($token, $this->user_role->token()->pluck('id')->toArray());
	}
	
	/**
	 * @return null|string
	 */
	public function getFullnameAttribute() {
		if (!empty($this->id)) {
			return "$this->name $this->surname";
		}
		return null;
	}
	
}
