<?php

namespace ikdev\ikpanel\App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class NotificationController extends BaseController {
	
	/**
	 * @param Request $request
	 * @return array
	 */
	public static function setRead($id) {
		$user = Auth::user();
		
		try {
			$notification = $user->notifications()
				->where('id', '=', $id)
				->first();
		} catch (QueryException $e) {
			throw $e;
		} // try
		
		if ($notification && is_null($notification->read_at)) {
			$notification->markAsRead();
		} // if
		
		return [true];
	}
	
	/**
	 * @param $status
	 * @return array
	 */
	public function showNotifications($status) {
		
		$user = Auth::user();
		
		switch ($status) {
			case 'all':
				$notifications = $user->notifications;
				break;
			case 'unread':
				$notifications = $user->unreadNotifications;
				break;
			default:
				$notifications = [];
		} // switch
		
		return $notifications;
		
	}
	
}
