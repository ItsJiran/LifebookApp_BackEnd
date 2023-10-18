<?php

namespace App\Http\Middleware;

use Auth;
use JWTAuth;
use Closure;

class ApiPriviledgeAdmin {

    public function __construct(){
        return auth()->shouldUse('api');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        

        // Check if the token is authenticated
        try {
            $jwt = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $jwt = false;
        } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e){
            $jwt = false;
        }

        if(!$jwt || !Auth::check()) return response('Unauthorized.', 401);

        // Check if the provided token has admin priviledge on it
        $user = auth()->user();

        if($user->role == 'admin') return $next($request);
        else                       return response('Forbidden Access', 403);
    }
}