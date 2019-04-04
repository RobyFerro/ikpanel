<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 04/04/2019
 * Time: 12:51
 */

namespace ikdev\ikpanel\app\Listeners;

use ikdev\ikpanel\app\Events\FoundExceptions;
use ikdev\ikpanel\app\Notifications\ReportException;
use ikdev\ikpanel\app\Users;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendFoundExceptionNotification implements ShouldQueue {
	
	public function __construct() {
		//
	}
	
	// Todo: Change users
	public function handle(FoundExceptions $event) {
		Notification::send(Users::find(1), new ReportException($event->error));
	}
	
}
