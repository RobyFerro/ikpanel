<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\app\Providers;

use ikdev\ikpanel\app\Policies\LogsPolicy;
use ikdev\ikpanel\app\Policies\RolesPolicy;
use ikdev\ikpanel\app\Policies\UserPolicy;
use ikdev\ikpanel\app\Users;
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;

class IkpanelAuthServiceProvider extends AuthServiceProvider {
	
	protected $policies = [
		Users::class => UserPolicy::class
	];
	
	public function boot() {
		$this->registerPolicies();
		
		Gate::resource('users', UserPolicy::class);
		Gate::resource('roles', RolesPolicy::class);
		Gate::resource('logs', LogsPolicy::class);
	}
	
}
