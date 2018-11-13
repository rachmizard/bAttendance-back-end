<?php

namespace App\Http\Middleware;

use Closure;
use App\Events\ExpiredSession;
use Auth;

class AdminMiddleware
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
        if (Auth::user()->role == 'pm' || Auth::user()->role == 'ga') {
                return redirect('/panel');
                // $message = "Your session was expired, login and get your session back.";
                // event(new ExpiredSession($message));
        }else{
            return $next($request);
        }
    }
}
