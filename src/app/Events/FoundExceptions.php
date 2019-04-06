<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 04/04/2019
 * Time: 12:48
 */

namespace ikdev\ikpanel\app\Events;


use ikdev\ikpanel\app\Errors;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class FoundExceptions implements ShouldBroadcast {
	use SerializesModels;
	
	public $error;
	
	public function __construct(Errors $errors) {
		$this->error = $errors;
	}
	
	public function broadcastOn() {
		return new PrivateChannel('exceptions');
	}
	
	public function broadcastAs() {
		return 'new';
	}
	
}
