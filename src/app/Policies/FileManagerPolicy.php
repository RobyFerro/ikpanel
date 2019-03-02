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

class FileManagerPolicy {
	use HandlesAuthorization;
	
	public function view(Users $users) {
		return $users->hasToken('SHOW_SETTINGS');
	}
}
