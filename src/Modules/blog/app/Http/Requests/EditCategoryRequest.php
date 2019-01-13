<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 13/01/2019
 * Time: 13:31
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest {
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'categoryID'          => 'required|exists:blog_category,id',
			'name'                => 'required|max:255',
			'keywords'            => 'nullable|max:255',
			'categoryDescription' => 'nullable'
		];
	}
	
	public function messages() {
		return [
			'categoryID.required' => __('ikpanel-blog.categories.errors.idRequired'),
			'categoryID,.exists'  => __('ikpanel-blog.categories.errors.idExists'),
			"name.required"       => __('ikpanel-blog::blog.categories.errors.nameRequired'),
			"name.max"            => __('ikpanel-blog::blog.categories.errors.nameMaxLength'),
			"keywords.max"        => __('ikpanel-blog::blog.categories.errors.nameMaxLength')
		];
	}
}