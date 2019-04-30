<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\calendar\app\Http\Requests;


use ikdev\ikpanel\App\Rules\DailyHours;
use ikdev\ikpanel\App\Rules\IsBeforeOrEqualDailyHours;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EventRequest extends FormRequest {
	
	protected $hours = [
		'startTime',
		'stopTime'
	];
	
	public function __construct(Request $request) {
		parent::__construct();
		$this->checkHours($request);
	}
	
	public function checkHours(Request $request) {
		foreach ($this->hours as $hour) {
			if ($request->get($hour) === 'Invalid date') {
				$request->request->remove($hour);
				$request->request->set($hour, '23:59');
			}
		}
	}
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'date'      => 'required|date_format:d/m/Y',
			'startTime' => [
				'required',
				new DailyHours,
				new IsBeforeOrEqualDailyHours($this->get('stopTime'), 'Stop')
			],
			'stopTime'  => [
				new DailyHours,
			],
			'allDay'    => 'required|boolean',
			'title'     => 'required',
			'content'   => 'string',
			'location'  => 'string'
		];
	}
	
}
