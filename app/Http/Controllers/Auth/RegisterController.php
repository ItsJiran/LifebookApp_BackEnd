<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function view(){
        return view('auth.register');
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','max:255','unique:'.User::class],
            'password' => ['required','min:6','required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => ['required','min:6']
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make( $request->password ),
        ]);

        Auth::login($user);
        $request->session()->put('user_id',$user->id);
        $request->session()->put('role',$user->role);
        return redirect('home');
    }

}
