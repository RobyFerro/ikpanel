<?php

namespace ikdev\ikpanel\Modules\gallery\app\Http\Requests;


use ikdev\ikpanel\App\Http\Requests\FormDataJsonRequest;

class NewGalleryImageRequest extends FormDataJsonRequest {
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'title'    => 'required|max:255',
			'keywords' => 'nullable|max:255',
			'pic'      => 'mimes:jpeg,bmp,png,jpg'
		];
	}
	
	public function messages() {
		return [
			//
		];
	}
	
}
