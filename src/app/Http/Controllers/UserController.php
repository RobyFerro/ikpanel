<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\App\Http\Controllers;

use Exception;
use ikdev\ikpanel\app\Http\Classes\PanelUtilities;
use ikdev\ikpanel\App\Http\Requests\users\AddUserRequest;
use ikdev\ikpanel\App\Http\Requests\users\EditUserRequest;
use ikdev\ikpanel\app\Logs;
use ikdev\ikpanel\app\Role;
use ikdev\ikpanel\app\Users;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends BaseController
{
    
    protected $user;
    
    public function __construct(Users $user)
    {
        $this->user = $user;
    }
    
    public function get()
    {
        return $this->user->all();
    }
    
    /**
     * Show all users in database
     * @return Factory|View
     * @throws Exception
     */
    public function show()
    {
        
        Logs::info('Ha visualizzato la vista "Utenti"');
        return view('ikpanel::user.show', [
            'users' => Users::all()
        ]);
    }
    
    /**
     * Show filtered results
     * @param  string  $filter
     * @return Factory|View
     */
    public function filter($filter = 'ACTIVE')
    {
        
        switch ($filter) {
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
        
        return view('ikpanel::user.table')->with([
            'users' => $users
        ]);
    }
    
    /**
     * Show new user GUI
     * @return Factory|View
     * @throws Exception
     */
    public function add()
    {
        //log
        Logs::info('Ha visualizzato la vista "Nuovo utente"');
        
        //restituisco la vista
        return view('ikpanel::user.new')->with([
            'roles' => Role::all()
        ]);
    }
    
    /**
     * Create new user
     * @param  AddUserRequest  $request
     * @return array
     * @throws Exception
     */
    public function insert(AddUserRequest $request)
    {
        
        DB::beginTransaction();
        
        try {
            $user = new Users();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->mail;
            $user->role = $request->role;
            $user->password = bcrypt($request->password);
            $user->save();
            
            //salvo avatar
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                PanelUtilities::saveUserAvatar($user->id, $request->file('avatar'));
            }
            
            DB::commit();
            
            //log
            Logs::success('Ha creato un utente: "{0} {1}" ({2})',
                $user->name,
                $user->surname,
                $user->id
            );
            
            return ['id' => $user->id];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    /**
     * Show edit user GUI
     * @param $id
     * @return Factory|View
     * @throws Exception
     */
    public function edit($id)
    {
        /** @var Users $user */
        $user = Users::find($id);
        $roles = Role::all();
        $roles = setIsSelected($roles, $user->role);
        
        Logs::info('Ha visualizzato la vista "{0}" di "{1} {2}" ({3})',
            'Modifica utente',
            $user->name,
            $user->surname,
            $user->id
        );
        
        return view('ikpanel::user.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }
    
    /**
     * Edit user
     * @param  EditUserRequest  $request
     * @return array
     * @throws Exception
     */
    public function update(EditUserRequest $request)
    {
        
        DB::beginTransaction();
        
        try {
            /** @var Users $user */
            $user = Users::find($request->id);
            $olduser = $user;
            
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->role = $request->role;
            $user->report_exceptions = $request->exceptionReports;
            
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            } // if
            
            if (!empty($request->username)) {
                $user->username = $request->username;
            } // if
            
            if (!empty($request->mail)) {
                $user->email = $request->mail;
            } // if
            
            $user->save();
            
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                PanelUtilities::saveUserAvatar($user->id, $request->file('avatar'));
            } // if
            
            DB::commit();
            
            //log
            Logs::warning('Ha modificato l\'utente "{0} {1}" ({2})',
                $olduser->name,
                $olduser->surname,
                $olduser->id
            );
            
            return [true];
            
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    /**
     * Delete user
     * @param $id
     * @return array
     * @throws Exception
     */
    public function delete($id)
    {
        
        try {
            
            /** @var Users $user */
            $user = Users::find($id);
            $user->delete();
            
            Logs::danger('Ha eliminato l\'utente "{0} {1}" ({2})',
                $user->name,
                $user->surname,
                $user->id
            );
            
            return [true];
        } catch (QueryException $e) {
            throw $e;
        }
        
    }
    
    /**
     * Restore user
     * @param $id
     * @return array
     * @throws Exception
     */
    public function restore($id)
    {
        
        try {
            /** @var Users $user */
            $user = Users::onlyTrashed()
                ->where('id', $id)
                ->first();
            $user->restore();
            
            Logs::warning('Ha ripristinato l\'utente "{0} {1}" ({2})',
                $user->name,
                $user->surname,
                $user->id
            );
            
            return [true];
        } catch (QueryException $e) {
            throw $e;
        }
    }
    
}
