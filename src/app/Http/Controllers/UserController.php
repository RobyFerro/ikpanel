<?php

namespace Ikdev\Ikpanel\App\Http\Controllers;

use Ikdev\Ikpanel\App\Http\Requests\UserDelete;
use Ikdev\Ikpanel\App\Http\Requests\UserEdit;
use Ikdev\Ikpanel\App\Http\Requests\UserRequest;
use Ikdev\Ikpanel\app\Role;
use Ikdev\Ikpanel\app\Users;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view('ikpanel::user.index', ['users' => Users::all()]);
    }

    public function edit($id)
    {
        return view('ikpanel::user.edit', ['user' => Users::find($id)]);
    }

    public function insert(UserRequest $request)
    {

        // Todo: Sostituire ruolo
        $mod_ruolo = Role::first();

        try {
            $mod_users = new Users();
            $mod_users->name = $request->name;
            $mod_users->surname = $request->surname;
            $mod_users->email = $request->mail;
            $mod_users->role = $mod_ruolo->id;
            $mod_users->password = bcrypt($request->password);
            $mod_users->save();
        } catch (QueryException $e) {
            throw $e;
        } // try
    }

    public function remove(UserDelete $request){
        try {
            $mod_users = new Users();
            $mod_users->find($request->id)->delete();
        } catch (QueryException $e) {
            throw $e;
        } // try
    }

    public function update(UserEdit $request){
        $user = Users::find($request->id);

        try {
            $user->name = $request->name;
            $user->surname = $request->surname;

            if(!empty($request->mail)){
                $user->email = $request->mail;
            } // if

            if(!empty($request->password)){
                $user->password = bcrypt($request->password);
            } // if

            $user->save();
        } catch (QueryException $e) {
            throw $e;
        } // try
    }

}
