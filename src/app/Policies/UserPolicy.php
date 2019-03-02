<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\app\Policies;

use ikdev\ikpanel\app\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {
	use HandlesAuthorization;
	
	/**
	 * Determine whether the user can view the users.
	 *
	 * @param Users $users
	 * @return mixed
	 */
	public function view(Users $users) {
		return $users->hasToken('SHOW_USERS');
	}
	
	/**
	 * Determine whether the user can create users.
	 *
	 * @param  \ikdev\ikpanel\app\Users $user
	 * @return mixed
	 */
	public function create(Users $user) {
		//
	}
	
	/**
	 * Determine whether the user can update the users.
	 *
	 * @param  \ikdev\ikpanel\app\Users $user
	 * @param Users $users
	 * @return mixed
	 */
	public function update(Users $user, Users $users) {
		//
	}
	
	/**
	 * Determine whether the user can delete the users.
	 *
	 * @param  \ikdev\ikpanel\app\Users $user
	 * @param Users $users
	 * @return mixed
	 */
	public function delete(Users $user, Users $users) {
		//
	}
	
	/**
	 * Determine whether the user can restore the users.
	 *
	 * @param  \ikdev\ikpanel\app\Users $user
	 * @param Users $users
	 * @return mixed
	 */
	public function restore(Users $user, Users $users) {
		//
	}
	
	/**
	 * Determine whether the user can permanently delete the users.
	 *
	 * @param  \ikdev\ikpanel\app\Users $user
	 * @param Users $users
	 * @return mixed
	 */
	public function forceDelete(Users $user, Users $users) {
		//
	}
}
