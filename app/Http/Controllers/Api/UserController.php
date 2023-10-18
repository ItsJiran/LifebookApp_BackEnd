<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\JWTokenController;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\View;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    public function store(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','max:255','email','unique:'.User::class],
            'password' => ['required','min:6','required_with:repassword','same:repassword'],
            'repassword' => ['required','min:6']
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make( $request->password ),
        ]);

        $jwt_controller = new JWTokenController();
        return $jwt_controller->login($request);
    }

}
