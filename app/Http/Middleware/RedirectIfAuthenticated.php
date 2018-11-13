<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->IdTipoUsuario == 1){
              return redirect('/main');
            }else if (Auth::user()->IdTipoUsuario == 2) {
              return redirect('/main');
            } else if (Auth::user()->IdTipoUsuario == 3) {
              return redirect('/main');
            }else if (Auth::user()->IdTipoUsuario == 4) {
              return redirect('/main');
            }else if (Auth::user()->IdTipoUsuario == 5) {
              return redirect('/observador');
            }
          }else{
            return $next($request);
          }
    }
}
