<?php

namespace ikdev\ikpanel\App\Http\Controllers;

use ikdev\ikpanel\App\Http\Requests\role\RoleEdit;
use ikdev\ikpanel\App\Http\Requests\role\RoleNew;
use ikdev\ikpanel\app\Role;
use ikdev\ikpanel\app\Token;
use Illuminate\Routing\Controller as BaseController;

class RoleController extends BaseController {
	/**
	 * Carica la vista ruoli
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show() {
		return view('ikpanel::role.show')->with([
			'roles' => Role::all()
		]);
	}
	
	/**
	 * Carica la vista per la creazione di un ruolo
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function add(){
		
		//ottengo la lista dei permessi disponibili
		$groups = Token::getList();
		
		//restituisco la vista
		return view('ikpanel::role.new')->with([
			'groups' => $groups
		]);
	}
	
	/**
	 * Salvo il nuovo ruolo
	 * @param RoleNew $request
	 * @return array
	 */
	public function insert(RoleNew $request){
	
		//inizializzo nuovo ruolo
		$role=new Role();
		
		//inserisco nome ruolo
		$role->group_name=$request->role_name;
		$role->save();
		
		//attacco i permessi al ruolo
		$role->token()->attach($request->permissions);
		
		//restituisco la risposta
		return ['id'=>$role->id];
	}
	
	/**
	 * Carica la vista per la modifica di un ruolo
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
	 */
	public function update(RoleEdit $request) {
		
		//ottengo ruolo corrente da id
		/** @var Role $role */
		$role = Role::find($request->role_id);
		
		//salvo nome ruolo
		$role->group_name = $request->role_name;
		$role->save();
		
		//elimino tutti i permessi
		$role->token()
		     ->detach();
		
		//associo i permessi al ruolo
		$role->token()
		     ->attach($request->permissions);
		
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
		
		//rimuovo tutti i permessi associati al ruolo
		$role->token()->detach();
		
		//elimino il ruolo (soft delete)
		$role->delete();
		
		//restituisco risposta
		return [true];
	}
}
