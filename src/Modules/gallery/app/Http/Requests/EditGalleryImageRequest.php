<?php

namespace ikdev\ikpanel\Modules\gallery\app\Http\Requests;


use ikdev\ikpanel\App\Http\Requests\FormDataJsonRequest;

class EditGalleryImageRequest extends FormDataJsonRequest {
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'imageID'  => 'required|exists:gallery_image,id',
			'title'    => 'required|max:255',
			'keywords' => 'nullable|max:255',
			'pic'      => 'nullable|mimes:jpeg,bmp,png,jpg'
		];
	}
	
	public function messages() {
		return [
			//
		];
	}
	
}
