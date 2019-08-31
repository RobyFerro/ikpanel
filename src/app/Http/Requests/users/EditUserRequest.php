<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\App\Http\Requests\users;


use ikdev\ikpanel\App\Rules\CanReportExceptions;
use ikdev\ikpanel\App\Traits\Requests\HandleJsonRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditUserRequest
 * @package ikdev\ikpanel\App\Http\Requests\users
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $mail
 * @property string $password
 * @property string $repassword
 * @property int $role
 */
class EditUserRequest extends FormRequest
{
    
    use HandleJsonRequest;
    
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
            'id' => 'required|exists:users,id',
            'name' => 'required|min:1|max:50',
            'surname' => 'required|min:1|max:50',
            'mail' => 'nullable|email|max:50|unique:users,email',
            'password' => 'nullable|min:1|max:255|same:repassword|required_with:repassword',
            'repassword' => 'nullable',
            'role' => 'required|exists:role,id',
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=50',
            "exceptionReports" => ['boolean', new CanReportExceptions()]
        ];
        
    }
    
    public function messages()
    {
        return [
            'id.required' => 'Il campo "id" è richiesto.',
            'id.exists' => 'Questo candidato non esiste.',
            'name.required' => 'Il campo "Nome" è richiesto.',
            'name.max' => 'Il campo "Nome" deve avere massimo 50 caratteri.',
            'name.min' => 'Il campo "Nome" deve avere minimo 1 carattere.',
            'surname.required' => 'Il campo "Cognome" è richiesto.',
            'surname.max' => 'Il campo "Cognome" deve avere massimo 50 caratteri.',
            'surname.min' => 'Il campo "Cognome" deve avere minimo 1 carattere.',
            'mail.max' => 'Il campo "Email" deve avere massimo 255 caratteri.',
            'mail.email' => 'Il campo "Email" non contiene una email valida.',
            'mail.unique' => 'Il campo "Email" esiste già nel database.',
            'password.max' => 'Il campo "Password" deve avere massimo 255 caratteri.',
            'password.min' => 'Il campo "Password" deve avere minimo 1 carattere.',
            'password.same' => 'Il campo "Password" deve essere uguale al campo "Ripeti password".',
            'password.required_with' => 'Il campo "Password" è richiesto.',
            'role.required' => 'Il campo "Ruolo" è richiesto.',
            'role.exists' => 'Il ruolo selezionato non esiste.',
            'avatar.required' => 'La foto del candidato è richiesta!',
            'avatar.mimes' => 'La foto del candidato deve essere un file jpeg o png!',
            'avatar.file' => 'La foto del candidato deve essere un file.',
            'avatar.max' => 'La foto del candidato non può superare i 2MB di grandezza!',
            'avatar.dimensions' => 'La foto del candidato deve essere minimo di 50 pixel larghezza/altezza.',
            'exceptionReports' => "Impossibile gestire i report delle eccezioni"
        ];
        
    }
}
