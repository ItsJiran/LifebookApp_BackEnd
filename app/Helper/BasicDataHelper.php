<?php

namespace App\Helper;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Materials;
use App\Models\Journals;

class BasicDataHelper{
    public static function getPatching($state){
        if($state == 'time')
            return time();
        if($state == 'version')
            return env('APP_VERSION',time());
    }
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
    public static function getJournalsData(Request $request){
        return Journals::where('user_id',$request->session()->get('user_id'))->orderBy('date','desc')->orderBy('time','desc')->get();
    }
}
