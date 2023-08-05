<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\View;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller{

    public function view(){
        return view('auth.login');
    }

    public function store(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $user = User::where('email',$request->email)->first();

            $request->session()->regenerate();
            $request->session()->put('user_id',$user->id);
            $request->session()->put('role',$user->role);

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
