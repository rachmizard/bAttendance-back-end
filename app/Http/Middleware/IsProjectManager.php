<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class IsProjectManager
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
        if (!Auth::user()->role == 'pm' || !Auth::user()->role == 'admin') {
            return redirect('/login');
        }
        return $next($request);
    }
}
