<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use JWTAuth;
use App\Models\ApiToken;

class JWTokenController extends Controller{
    
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','refresh']]);
        return auth()->shouldUse('api');
    }
    
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required','string','max:255','email'],
            'password' => ['required','min:6'],
        ]);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($this->respondFull($token),200);
    }

    public function me(){
        $user = auth('api')->user();
        
        return response()->json([
            'id' => $user->id,
            'email' => $user->email,
            'role' => $user->role
        ]);
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(Request $request){
        try{
            $header = $request->header('Authorization');
            $token = explode(' ', $header)[1];
    
            $token = JWTAuth::getToken();
            $newToken = JWTAuth::refresh($token);
            
            return $this->respondJWT($newToken);
        } catch(\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e){
            return response()->json(['message'=>'Your token maybe get blacklisted or expired, You can try to re-authenticate..'],401);
        }   
    }

    protected function respondJWT($token){
        return [            
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }
    protected function respondFull($token){
        $user = auth()->user();

        return [
            'jwt' => $this->respondJWT($token),
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role
            ],
        ];
    }

}
