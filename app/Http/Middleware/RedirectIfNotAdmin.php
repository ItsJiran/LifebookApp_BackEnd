<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RedirectIfNotAdmin{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        if($request->session()->get('role') !== 'admin') return redirect('home');
        return $next($request);
    }
}
