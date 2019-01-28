<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 13/01/2019
 * Time: 14:54
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Requests;


use ikdev\ikpanel\App\Http\Requests\FormDataJsonRequest;

class NewPostRequest extends FormDataJsonRequest {
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'title'    => 'required|max:255',
			'content'  => 'required',
			'keywords' => 'nullable|max:255',
			'main_pic' => 'nullable|mimes:jpeg,bmp,png,jpg'
		];
	}
	
	public function messages() {
		return [
			'title.required'   => __('ikpanel-blog::blog.articles.new.errors.titleRequired'),
			'title.max'        => __('ikpanel-blog::blog.articles.new.errors.titleMaxLength'),
			'content.required' => __('ikpanel-blog::blog.articles.new.errors.contentRequired'),
			'keywords.max'     => __('ikpanel-blog::blog.articles.new.errors.keywordsMaxLength'),
			'main_pic.mimes'   => __('ikpanel-blog::blog.articles.new.errors.mainPicWrongMime')
		];
	}
	
}
