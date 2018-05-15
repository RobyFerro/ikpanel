<?php

namespace ikdev\ikpanel\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
            "mail" => 'required|unique:users,email',
            "name" => "required",
            "surname" => "required",
            "password" => "same:password_1|min:8|required",
            "password_1" => "same:password|min:8|required",
        ];
    }

    public function messages()
    {
        return [
            "mail.required" => "L'indirizzo mail è necessario.",
            "mail.unique" => "L'indirizzo inserito è già presente all'interno del database.",
            "name.required" => "Il nome è necessario",
            "surname.required" => "Il cognome è necessario",
            "password.same" => "Le password inserite non corrispondono",
            "password_1.same" => "Le password inserite non corrispondono",
            "password.min" => "La password deve essere minimo di 8 caratteri.",
            "password_1.min" => "La password deve essere minimo di 8 caratteri.",
            "password.required" => "La password è necessaria",
            "password_1.required" => "La password è necessaria",
        ];
    }
}
