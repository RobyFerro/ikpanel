<?php

namespace ikdev\ikpanel\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserDelete extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            "id" => "exists:users,id"
        ];
    }

    public function messages()
    {
        return [
            "id.exists" => "L'utente selezionato non esiste"
        ];
    }
}
