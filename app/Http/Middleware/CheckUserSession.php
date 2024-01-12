<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!isset($_SESSION)) session_start();

        if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
            return redirect()->route('user.login');
        }
        
        // redirect se utente già loggato e cerca di accedere a queste due pagine
        if($request->path == "user/login" || $request->path == "user/signup"){
            return redirect()->route('home');
        }

        return $next($request);
    }
}
