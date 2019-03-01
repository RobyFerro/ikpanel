<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\Modules\gallery\app\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class NewGalleryCategoryRequest extends FormRequest {
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'name'                => 'required|max:255',
			'keywords'            => 'nullable|max:255',
			'categoryDescription' => 'nullable'
		];
	}
	
	public function messages() {
		return [
			'categoryID,.exists' => __('ikpanel-gallery::gallery.categories.errors.idExists'),
			"name.required"      => __('ikpanel-gallery::gallery.categories.errors.nameRequired'),
			"name.max"           => __('ikpanel-gallery::gallery.categories.errors.nameMaxLength'),
			"keywords.max"       => __('ikpanel-gallery::gallery.categories.errors.nameMaxLength')
		];
	}
	
}
