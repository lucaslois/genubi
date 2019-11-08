<?php

namespace App\Http\Middleware;

use App\Facades\Alert;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() == false) {
            Alert::send('Debes iniciar sesión para continuar navegando...');

            session()->put('last_page', $request->url());
            return redirect()->route('login.index');
        }

        return $next($request);
    }
}
