<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\App\Http\Controllers;

use ikdev\ikpanel\app\Http\Requests\role\RoleEdit;
use ikdev\ikpanel\app\Http\Requests\role\RoleNew;
use ikdev\ikpanel\app\Logs;
use ikdev\ikpanel\app\Role;
use ikdev\ikpanel\app\Token;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;

class RoleController extends BaseController {
    /**
     * Carica la vista ruoli
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show() {
        //log
        Logs::info('Ha visualizzato la vista "Ruoli"');

        //restituisco la vista
        return view('ikpanel::role.show')->with([
            'roles' => Role::all()
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
                $roles = Role::all();
                break;
            case 'DELETED':
                $roles = Role::onlyTrashed()->get();
                break;
            case 'ALL':
                $roles = Role::withTrashed()->get();
                break;
        }

        //restituisco la vista
        return view('ikpanel::role.table')->with([
            'roles' => $roles
        ]);
    }

    /**
     * Carica la vista per la creazione di un ruolo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function add(){
        //ottengo la lista dei permessi disponibili
        $groups = Token::getList();

        //log
        Logs::info('Ha visualizzato la vista "Nuovo ruolo"');

        //restituisco la vista
        return view('ikpanel::role.new')->with([
            'groups' => $groups
        ]);
    }

    /**
     * Salvo il nuovo ruolo
     * @param RoleNew $request
     * @return array
     * @throws \Exception
     */
    public function insert(RoleNew $request){
        //inizializzo nuovo ruolo
        $role=new Role();

        //inserisco nome ruolo
        $role->group_name=$request->role_name;
        $role->save();

        //attacco i permessi al ruolo
        $role->token()->attach($request->permissions);

        //log
        Logs::success('Ha creato un nuovo ruolo ({0})',$role->id);

        //restituisco la risposta
        return ['id'=>$role->id];
    }

    /**
     * Carica la vista per la modifica di un ruolo
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit($id) {
        //ottengo ruolo corrente
        $role = Role::find($id);

        //ottengo gli id dei permessi che il ruolo corrente
        $rolePermissions = $role->token->pluck('id')
            ->toArray();

        //ottengo la lista dei permessi disponibili
        $groups = Token::getList();

        //inserisco isChecked ai permessi
        foreach($groups as &$group) {
            foreach($group->token as &$token) {
                $token->isChecked = in_array($token->id, $rolePermissions) ? 'checked' : '';

                foreach($token->children as &$child) {
                    $child->isChecked = in_array($child->id, $rolePermissions) ? 'checked' : '';
                }
            }
        }

        //elimino variabili di scarto
        unset($group, $token, $child);

        //log
        Logs::info('Ha visualizzato la vista "Modifica ruolo" ({0})',$id);

        //restituisco la vista
        return view('ikpanel::role.edit')->with([
            'role'   => $role,
            'groups' => $groups
        ]);
    }

    /**
     * Modifica il ruolo
     * @param RoleEdit $request
     * @return array
     * @throws \Exception
     */
    public function update(RoleEdit $request) {

        //ottengo ruolo corrente da id
        /** @var Role $role */
        $role = Role::find($request->role_id);

        //vecchio ruolo
        $oldRole=$role;

        //salvo nome ruolo
        $role->group_name = $request->role_name;
        $role->save();

        //elimino tutti i permessi
        $role->token()
            ->detach();

        //associo i permessi al ruolo
        $role->token()
            ->attach($request->permissions);

        //log
        Logs::warning('Ha modificato il ruolo "{0}" ({1})',$oldRole->group_name,$oldRole->id);

        //restituisco risposta
        return [true];
    }

    /**
     * Elimino un ruolo
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function delete($id){

        //ottengo il ruolo
        /** @var Role $role */
        $role=Role::find($id);

        //vecchio ruolo
        $oldRole=$role;

        //rimuovo tutti i permessi associati al ruolo
        $role->token()->detach();

        //elimino il ruolo (soft delete)
        $role->delete();

        //log
        Logs::danger('Ha eliminato il ruolo "{0}" ({1})',$oldRole->group_name,$oldRole->id);

        //restituisco risposta
        return [true];
    }

    /**
     * Ripristino un ruolo precedentemente eliminato
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function restore($id){

        try{
            //ottengo il ruolo
            /** @var Role $role */
            $role = Role::onlyTrashed()
                ->where('id', $id)
                ->first();

            //ripristino il ruolo
            $role->restore();

            //log
            Logs::warning('Ha ripristinato il ruolo "{0}" ({1})',
                $role->group_name,
                $role->id
            );

            //restituisco risposta
            return [true];
        }
        catch(QueryException $e){
            throw $e;
        }
    }
}
