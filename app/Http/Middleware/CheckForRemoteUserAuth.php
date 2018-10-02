<?php

namespace App\Http\Middleware;

use Closure;

class CheckForRemoteUserAuth {

    public function handle($request, Closure $next) {
        if (!$request->session()->exists('sb.byond_ckey')) {
            // user value cannot be found in session
            return redirect('/');
        }

        return $next($request);
    }

}