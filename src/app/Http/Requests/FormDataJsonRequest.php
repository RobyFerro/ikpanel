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
use Illuminate\Http\Request;

class FormDataJsonRequest extends FormRequest
{
    
    public function __construct(Request $request)
    {
        
        $data = json_decode($request->data, true);
        $request->request->remove('data');
        
        foreach ($data as $item) {
            $value = isset($item['value']) ? $item['value'] : null;
            
            if (is_string($value) && strlen($value) == 0) {
                $value = null;
            } // if
            
            $request->request->set($item['id'], $value);
        } // foreach
    }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
