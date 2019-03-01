<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest {
	
	public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null) {
		parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
		
		$data = json_decode(request()->input('data'), true);
		request()->request->remove('data');
		foreach ($data as $key => $item) {
			$newvalue = isset($item) ? $item : null;
			$newvalue = is_string($newvalue) && empty($newvalue) ? null : $newvalue;
			request()->request->set($key, $newvalue);
		}
	}
	
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return false;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			//
		];
	}
}
