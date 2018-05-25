<?php

namespace ikdev\ikpanel\App\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoleEdit extends FormRequest
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
	 * @param Request $request
	 * @return array
	 */
    public function rules(Request $request)
    {
    	$rules=[];
	
	    $rules['role_id'] = 'exists:role,id';
	    $rules['role_name'] = 'required|min:1|max:50';
	    $rules['permissions.*']='exists:token,id';
    	
        return $rules;
    }

    public function messages()
    {
        return [
            "role_id.exists" => "L'id del ruolo non è valido.",

            "role_name.required" => "Il nome è necessario.",
            "role_name.min" => "Il nome deve avere minimo 1 carattere.",
            "role_name.max" => "Il nome deve avere massimo 50 caratteri.",

            "permissions.*.exists" => "I permessi inseriti no sono validi."
        ];
    }
}
