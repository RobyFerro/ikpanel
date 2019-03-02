<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\app\Providers;

use ikdev\ikpanel\app\Policies\FileManagerPolicy;
use ikdev\ikpanel\app\Policies\LogsPolicy;
use ikdev\ikpanel\app\Policies\RolesPolicy;
use ikdev\ikpanel\app\Policies\UserPolicy;
use ikdev\ikpanel\app\Users;
use ikdev\ikpanel\Modules\blog\app\Policies\ArticlesPolicy;
use ikdev\ikpanel\Modules\blog\app\Policies\CategoriesPolicy;
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
		Gate::define('file-manager.view', 'ikdev\ikpanel\app\Policies\FileManagerPolicy@view');
		
		// BLOG POLICY
		Gate::resource('blog-articles', ArticlesPolicy::class);
		Gate::resource('blog-categories', CategoriesPolicy::class);
	}
	
}
