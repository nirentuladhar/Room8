<?php

namespace App\Http\Middleware\Authorization;

use Closure;
use Illuminate\Support\Facades\Auth;

class TransactionAuthorization
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
        if ($request->route()->hasParameter('transaction')) {
            $transaction = $request->route()->parameter('transaction');
            if (in_array($transaction->toArray(), $user->transactions->toArray())) {
                return $next($request); // Authorized
            }
            return abort(403); // Unauthorized
        }

        return $next($request);
    }
}
