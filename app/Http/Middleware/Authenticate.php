<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Illuminate\Support\Facades\Auth;

class Authenticate
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
        if (Auth::guard($guard)->guest()) {
            Log::info('GUARD GUARD GUEST');
            if ($request->ajax()) {
                Log::info('Unauthorized');
                return response('Unauthorized.', 401);
            } else {
                Log::info('redirect');
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
