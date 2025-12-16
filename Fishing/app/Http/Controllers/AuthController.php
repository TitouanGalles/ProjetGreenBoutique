<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('connexion');
    }

    public function login(Request $request)
    {
        $login = $request->input('login');
        $pwd = $request->input('pwd');

        if ($login === 'root' && $pwd === 'root') {
            session(['login' => $login, 'pwd' => $pwd]);
            return redirect('/backoffice');
        } else {
            return redirect('/connexion')->with('error', 'Membre non reconnu...');
        }
    }

    public function logout()
    {
        session()->forget(['login', 'pwd']);
        return redirect('/');
    }
}