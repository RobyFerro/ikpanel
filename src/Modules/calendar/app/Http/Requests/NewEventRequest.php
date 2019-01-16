<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 16/01/2019
 * Time: 18:30
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
