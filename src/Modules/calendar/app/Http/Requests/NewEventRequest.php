<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\calendar\app\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class NewEventRequest extends FormRequest {
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
		
		];
	}
	
	public function messages() {
		return [
		
		];
	}
}
