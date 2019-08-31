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

class EditGalleryCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'categoryID' => 'required|exists:gallery_category,id',
            'name' => 'required|max:255',
            'keywords' => 'nullable|max:255',
            'categoryDescription' => 'nullable'
        ];
    }
    
    public function messages()
    {
        return [
            'categoryID.required' => __('ikpanel-gallery.categories.errors.idRequired'),
            'categoryID,.exists' => __('ikpanel-gallery.categories.errors.idExists'),
            "name.required" => __('ikpanel-gallery::blog.categories.errors.nameRequired'),
            "name.max" => __('ikpanel-gallery::blog.categories.errors.nameMaxLength'),
            "keywords.max" => __('ikpanel-gallery::blog.categories.errors.nameMaxLength')
        ];
    }
}
