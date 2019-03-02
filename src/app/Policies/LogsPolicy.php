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

class LogsPolicy {
	use HandlesAuthorization;
	
	public function view(Users $user) {
		return $user->hasToken('SHOW_LOGS');
	}
	
	public function create(Users $users) {
		return $users->hasToken('SHOW_LOGS');
	}
	
	public function update(Users $users) {
		return $users->hasToken('SHOW_LOGS');
	}
	
	public function delete(Users $users) {
		return $users->hasToken('SHOW_LOGS');
	}
	
	public function restore(Users $users) {
		return $users->hasToken('SHOW_LOGS');
	}
	
	public function forceDelete(Users $users) {
		return $users->hasToken('SHOW_LOGS');
	}
}
