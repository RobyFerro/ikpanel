<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 13/01/2019
 * Time: 14:35
 */

namespace ikdev\ikpanel\Modules\blog\app\Http\Requests;

use ikdev\ikpanel\App\Http\Requests\FormDataJsonRequest;

class EditPostRequest extends FormDataJsonRequest {
	
	public function authorize() {
		return true;
	}
	
	public function rules() {
		return [
			'author'      => 'required|exists:users,id',
			'owner_alias' => 'nullable',
			'title'       => 'required|max:255',
			'description' => 'nullable',
			'content'     => 'required',
			'keywords'    => 'nullable|max:255',
			'main_pic'    => 'nullable|mimes:jpeg,bmp,png,jpg'
		];
	}
	
	public function messages() {
		return [
			"title.required"   => __('ikpanel-blog::blog.articles.edit.errors.titleRequired'),
			"title.max"        => __('ikpanel-blog::blog.articles.edit.errors.titleMaxLength'),
			"content.required" => __('ikpanel-blog::blog.articles.edit.errors.contentRequired'),
			'author.required'  => __('ikpanel-blog::blog.articles.edit.errors.ownerRequired'),
			'author.exist'     => __('ikpanel-blog::blog.articles.edit.errors.ownerExist'),
			'keywords.max'     => __('ikpanel-blog::blog.articles.edit.errors.keywordsMaxLength'),
			'main_pic.mimes'   => __('ikpanel-blog::blog.articles.edit.errors.mainPicWrongMime')
		];
	}
	
}
