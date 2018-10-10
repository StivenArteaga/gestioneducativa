<?php

namespace App\Http\Middleware;

use Closure;

class Secretarias
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
        if (Auth::user()->IdTipoUsuario != 3) {
            return redirect('/');
          }else{
            return $next($request);
          }
    }
}
