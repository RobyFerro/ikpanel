<?php

namespace ikdev\ikpanel\App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
	/**
	 * EditUserRequest constructor.
	 * @param Request $request
	 */
	public function __construct(Request $request) {
		
		$data = json_decode($request->data, true);
		$request->request->remove('data');
		
		foreach ($data as $item) {
			$myvalue = isset($item['value']) ? $item['value'] : null;
			
			if (is_string($myvalue) && strlen($myvalue) == 0) {
				$myvalue = null;
			} // if
			
			$request->request->set($item['id'], $myvalue);
		} // foreach
	}
	
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
    	$rules=[];
	
	    $rules['id'] = 'required|exists:users,id';
	    $rules['name'] = 'required|min:1|max:50';
	    $rules['surname'] = 'required|min:1|max:50';
	    $rules['mail'] = 'nullable|email|max:50|unique:users,email';
	    $rules['password'] = 'nullable|min:1|max:255|same:repassword|required_with:repassword';
	    $rules['repassword'] = 'nullable';
	    $rules['role'] = 'required|exists:role,id';
	    $rules['avatar'] = 'nullable|file|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=50';
        
        return $rules;
    }

    public function messages()
    {
    	$message=[];
	
	    $message['id.required'] = 'Il campo "id" è richiesto.';
	    $message['id.exists'] = 'Questo candidato non esiste.';
	    $message['name.required'] = 'Il campo "Nome" è richiesto.';
	    $message['name.max'] = 'Il campo "Nome" deve avere massimo 50 caratteri.';
	    $message['name.min'] = 'Il campo "Nome" deve avere minimo 1 carattere.';
	    $message['surname.required'] = 'Il campo "Cognome" è richiesto.';
	    $message['surname.max'] = 'Il campo "Cognome" deve avere massimo 50 caratteri.';
	    $message['surname.min'] = 'Il campo "Cognome" deve avere minimo 1 carattere.';
	    $message['mail.max'] = 'Il campo "Email" deve avere massimo 255 caratteri.';
	    $message['mail.email'] = 'Il campo "Email" non contiene una email valida.';
	    $message['mail.unique'] = 'Il campo "Email" esiste già nel database.';
	    $message['password.max'] = 'Il campo "Password" deve avere massimo 255 caratteri.';
	    $message['password.min'] = 'Il campo "Password" deve avere minimo 1 carattere.';
	    $message['password.same'] = 'Il campo "Password" deve essere uguale al campo "Ripeti password".';
	    $message['password.required_with'] = 'Il campo "Password" è richiesto.';
	    $message['role.required'] = 'Il campo "Ruolo" è richiesto.';
	    $message['role.exists'] = 'Il ruolo selezionato non esiste.';
	    $message['avatar.required'] = 'La foto del candidato è richiesta!';
	    $message['avatar.mimes'] = 'La foto del candidato deve essere un file jpeg o png!';
	    $message['avatar.file'] = 'La foto del candidato deve essere un file.';
	    $message['avatar.max'] = 'La foto del candidato non può superare i 2MB di grandezza!';
	    $message['avatar.dimensions'] = 'La foto del candidato deve essere minimo di 50 pixel larghezza/altezza.';
	    
	    return $message;
    }
}
