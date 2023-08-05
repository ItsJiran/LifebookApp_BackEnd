<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Materials;

class BasicDataHelper{
    public static function getUserData(Request $request){
        $user = User::where('id',$request->session()->get('user_id'))->first();
        return [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ];
    }
    public static function getMaterialsData(Request $request){
        $materials = Materials::orderBy('date','desc')->get();

        foreach($materials as $material)
            $material->date = explode(' ', $material->date)[0];

        return $materials;
    }
}
