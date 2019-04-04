<?php

namespace ikdev\ikpanel\app\Notifications;

use ikdev\ikpanel\app\Mail\ExceptionReported;
use ikdev\ikpanel\app\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class ReportException extends Notification {
	
	use Queueable;
	
	protected $error;
	
	/**
	 * Create a new notification instance.
	 *
	 * @param $error
	 */
	public function __construct($error) {
		$this->error = $error;
	}
	
	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['mail'];
	}
	
	/**
	 * @param $notifiable
	 * @return mixed
	 */
	public function toMail($notifiable) {
		return new ExceptionReported($this->error, $notifiable);
	}
	
	/**
	 * Get the array representation of the notification.
	 *
	 * @param mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			//
		];
	}
}
