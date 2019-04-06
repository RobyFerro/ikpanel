<?php

namespace ikdev\ikpanel\App\Broadcasting;

use ikdev\ikpanel\app\Users;

class FoundExceptionChannel {
	/**
	 * Create a new channel instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}
	
	/**
	 * Authenticate the user's access to the channel.
	 *
	 * @param Users $user
	 * @return array|bool
	 */
	public function join(Users $user) {
		return $user->hasToken('SHOW_EXCEPTIONS');
	}
}
