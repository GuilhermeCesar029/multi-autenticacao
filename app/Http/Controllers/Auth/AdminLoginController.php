<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    //se o usuario estiver autenticado como login nao precisa acessar a tela de login.
    public function __contruct(){
        $this->middleware('guest:admin');
    }

    public function index(){
        return view('auth.admin-login');
    }

    public function login(Request $request){
        //se o usuario nao digitar nada da erro.
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];
        //
        $authOK = Auth::guard('admin')->attempt($credentials, $request->remember);

        if($authOK){
            return redirect()->intended(route('admin.index'));
        }else{
            return redirect()->route('admin.login');
        }
    }
}
