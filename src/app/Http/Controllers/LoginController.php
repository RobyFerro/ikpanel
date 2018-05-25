<?php

namespace ecit\admin_panel\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->put('version', shell_exec('git describe --tags'));
            return view('ikpanel::dashboard');
        }

        return view('ikpanel::login');
    }

    public function logout(){
        Auth::logout();
        return view('ikpanel::login');
    }
}
