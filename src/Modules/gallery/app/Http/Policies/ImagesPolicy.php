<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\gallery\app\Http\Policies;


use ikdev\ikpanel\app\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagesPolicy {
	use HandlesAuthorization;
	
	public function view(Users $user) {
		return $user->hasToken('SHOW_GALLERY');
	}
	
	public function create(Users $user) {
		return $user->hasToken('SHOW_GALLERY');
	}
	
	public function update(Users $user) {
		return $user->hasToken('SHOW_GALLERY');
	}
	
	public function delete(Users $user) {
		return $user->hasToken('SHOW_GALLERY');
	}
	
	public function restore(Users $user) {
		return $user->hasToken('SHOW_GALLERY');
	}
	
	public function forceDelete(Users $user) {
		return $user->hasToken('SHOW_GALLERY');
	}
}
