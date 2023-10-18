<?php

namespace App\Http\Middleware;

use Auth;
use JWTAuth;
use Closure;

class ApiAuth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        try {
            $jwt = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $jwt = false;
        } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e){
            $jwt = false;
        }
        if (Auth::check() || $jwt) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}