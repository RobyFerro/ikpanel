<?php

namespace ikdev\ikpanel\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->put('version', shell_exec('git describe --tags'));
        }
        
        return redirect(admin_url());
    }

    public function logout(){
        Auth::logout();
        return redirect(admin_url());
    }
}
