<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 13/01/2019
 * Time: 14:54
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class NewPostRequest extends FormRequest {
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'title'    => 'required|max:255',
			'content'  => 'required',
			'keywords' => 'nullable|max:255'
		];
	}
	
	public function messages() {
		return [
			'title.required'   => __('ikpanel-blog::blog.articles.new.errors.titleRequired'),
			'title.max'        => __('ikpanel-blog::blog.articles.new.errors.titleMaxLength'),
			'content.required' => __('ikpanel-blog::blog.articles.new.errors.contentRequired'),
			'keywords.max'     => __('ikpanel-blog::blog.articles.edit.errors.keywordsMaxLength')
		];
	}
	
}