<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function login()
    {
        $credentials = $this->validate(request(), [
            'email' =>'email|required|string',
            'Contrasena' =>'required|string'
        ]);

        
        if (Auth::attempt(['email'=> $credentials['email'] , 'password' => $credentials['Contrasena'] ] )) 
        {
            return redirect()->route('main');
        }    

        return back()
        ->withErrors([ 'email' => trans('auth.failed')])
        ->withInput(request(['email']));
    }

    public function showLoginForm()
    {
        return View('layouts.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

}
