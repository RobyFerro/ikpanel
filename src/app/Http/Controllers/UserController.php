<?php

namespace ikdev\ikpanel\App\Http\Controllers;


use ikdev\ikpanel\App\Http\Requests\users\AddUserRequest;
use ikdev\ikpanel\App\Http\Requests\users\EditUserRequest;
use ikdev\ikpanel\app\Logs;
use ikdev\ikpanel\app\Role;
use ikdev\ikpanel\app\Users;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController{

    /**
     * Carica la vista per la visualizzazione di tutti gli utenti
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(){
        //log
        Logs::info('Ha visualizzato la vista "Utenti"');

        //restituisco la vista
        return view('ikpanel::user.show', [
            'users' => Users::all()
        ]);
    }

    /**
     * Carica la vista filtrata per stato
     * @param string $filter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filter($filter = 'ACTIVE'){

        switch($filter){
            case 'ACTIVE':
            default:
                $users = Users::all();
                break;
            case 'DELETED':
                $users = Users::onlyTrashed()->get();
                break;
            case 'ALL':
                $users = Users::withTrashed()->get();
                break;
        }

        //restituisco la vista
        return view('ikpanel::user.table')->with([
            'users' => $users
        ]);
    }

    /**
     * Carica la vista per la creazione di un utente
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function add(){
        //log
        Logs::info('Ha visualizzato la vista "Nuovo utente"');

        //restituisco la vista
        return view('ikpanel::user.new')->with([
            'roles' => Role::all()
        ]);
    }

    /**
     * Crea un utente
     * @param AddUserRequest $request
     * @return array
     * @throws \Exception
     */
    public function insert(AddUserRequest $request){
        try{
            //salva utente
            $user=new Users();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->mail;
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->save();

            //log
            Logs::success('Ha creato un utente: "{0} {1}" ({2})',
                $user->name,
                $user->surname,
                $user->id
            );

            //restituisco risposta
            return ['id'=>$user->id];
        }
        catch(QueryException $e){
            throw $e;
        }
    }

    /**
     * Carica la vista per la modifica di un utente
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit($id){
        //ottengo l'utente corrente
        /** @var Users $user */
        $user = Users::find($id);

        //ottengo i ruoli
        $roles = Role::all();

        //imposta il ruolo seleziona dall'utente
        $roles = setIsSelected($roles, $user->role);

        //log
        Logs::info('Ha visualizzato la vista "{0}" di "{1} {2}" ({3})',
            'Modifica utente',
            $user->name,
            $user->surname,
            $user->id
        );

        //restituisco la vista
        return view('ikpanel::user.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Modifica un utente
     * @param EditUserRequest $request
     * @return array
     * @throws \Exception
     */
    public function update(EditUserRequest $request){

        try{

            //ottengo l'utente corrente
            /** @var Users $user */
            $user = Users::find($request->id);
            $olduser = $user;

            //salvo i dati
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->role = $request->role;

            if(!empty($request->password)){
                $user->password = bcrypt($request->password);
            }

            if(!empty($request->mail)){
                $user->email = $request->mail;
            }

            $user->save();

            //log
            Logs::warning('Ha modificato l\'utente "{0} {1}" ({2})',
                $olduser->name,
                $olduser->surname,
                $olduser->id
            );

            //restituisco risposta
            return [true];

        }
        catch(QueryException $e){
            throw $e;
        }
    }

    /**
     * Elimina un utente
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function delete($id){

        try{
            //ottengo il modello
            /** @var Users $user */
            $user = Users::find($id);

            //elimino modello (soft delete, quindi non è necessario eliminare eventuali associazioni)
            $user->delete();

            //log
            Logs::danger('Ha eliminato l\'utente "{0} {1}" ({2})',
                $user->name,
                $user->surname,
                $user->id
            );

            //restituisco risposta
            return [true];
        }
        catch(QueryException $e){
            throw $e;
        }

    }

    /**
     * Ripristino un utente precedentemente eliminato
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function restore($id){

        try{
            //ottengo l'utente
            /** @var Users $user */
            $user = Users::onlyTrashed()
                ->where('id', $id)
                ->first();

            //ripristino l'utente
            $user->restore();

            //log
            Logs::warning('Ha ripristinato l\'utente "{0} {1}" ({2})',
                $user->name,
                $user->surname,
                $user->id
            );

            //restituisco risposta
            return [true];
        }
        catch(QueryException $e){
            throw $e;
        }
    }

}
