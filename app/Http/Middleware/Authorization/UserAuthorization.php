<?php

namespace App\Http\Middleware\Authorization;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthorization
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
        $user = Auth::user();
        if ($request->route()->hasParameter('user')) {
            $user = $request->route()->parameter('user');
            if ($user->id == Auth::user()->id) {
                return $next($request); // Authorized
            }
        }
        return abort(403); // Unauthorized
    }
}