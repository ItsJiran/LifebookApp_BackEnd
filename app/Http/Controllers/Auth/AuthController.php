<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\View;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{

    public function view(){
        return view('login');
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

}
