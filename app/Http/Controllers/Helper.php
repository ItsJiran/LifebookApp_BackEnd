<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class Helper extends Controller{
    public static function getUserData(Request $request){
        $user = User::where('id',$request->session()->get('user_id'))->first();
        return [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ];
    }
}
