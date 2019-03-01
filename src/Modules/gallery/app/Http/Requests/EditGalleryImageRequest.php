<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

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
