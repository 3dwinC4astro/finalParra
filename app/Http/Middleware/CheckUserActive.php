<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado === 'inactivo') {
            Auth::logout();
            return redirect('/login')->with('error', 'Tu cuenta está inactiva. Contacta al administrador.');
        }

        return $next($request);
    }
}
