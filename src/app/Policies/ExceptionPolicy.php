<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 25/03/2019
 * Time: 11:23
 */

namespace ikdev\ikpanel\app\Policies;


use ikdev\ikpanel\app\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExceptionPolicy {
	use HandlesAuthorization;
	
	//Todo: Insert new token in followings methods
	
	/**
	 * Determine whether the user can view the users.
	 *
	 * @param Users $user
	 * @return mixed
	 */
	public function view(Users $user) {
		return $user->hasToken('');
	}
	
	/**
	 * Determine whether the user can create users.
	 *
	 * @param Users $user
	 * @return mixed
	 */
	public function create(Users $user) {
		return $user->hasToken('');
	}
	
	/**
	 * Determine whether the user can update the users.
	 *
	 * @param Users $user
	 * @return mixed
	 */
	public function update(Users $user) {
		return $user->hasToken('');
	}
	
	/**
	 * Determine whether the user can delete the users.
	 *
	 * @param Users $user
	 * @return mixed
	 */
	public function delete(Users $user) {
		return $user->hasToken('');
	}
	
	/**
	 * Determine whether the user can restore the users.
	 *
	 * @param  \ikdev\ikpanel\app\Users $user
	 * @return mixed
	 */
	public function restore(Users $user) {
		return $user->hasToken('');
	}
	
	/**
	 * Determine whether the user can permanently delete the users.
	 *
	 * @param  \ikdev\ikpanel\app\Users $user
	 * @return mixed
	 */
	public function forceDelete(Users $user) {
		return $user->hasToken('');
	}
}
