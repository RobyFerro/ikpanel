<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\app\Providers;

use ikdev\ikpanel\app\Events\FoundExceptions;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use ikdev\ikpanel\app\Listeners\SendFoundExceptionNotification;

class IkpanelEventServiceProvider extends ServiceProvider {
	
	protected $listen = [
		FoundExceptions::class => [
			SendFoundExceptionNotification::class
		]
	];
	
	public function boot() {
		parent::boot();
	}
	
}
