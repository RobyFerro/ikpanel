<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "password" => 'nullable|min:8|max:255|same:rpassword',
            "rpassword" => "nullable|required_with:password",
        ];
    }
    
    public function messages()
    {
        return [
            'password.same' => 'Le password inserite non corrispondono.',
            'password.min' => 'Il campo "Password" deve essere minimo di 8 caratteri.',
            'password.max' => 'Il campo "Password" deve avere massimo 255 caratteri.',
            'rpassword.required_with' => 'Il campo "Ripeti Password" è richiesto.'
        ];
    }
}
