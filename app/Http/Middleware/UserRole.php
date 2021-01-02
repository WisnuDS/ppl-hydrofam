<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$role)
    {
        if(Auth::guest()){
            return redirect('/login');
        }

        $user = $request->user();
        if($user->isA($role)){
            return $next($request);
        }

        return redirect('/login');
    }
}
