<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckVerified
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
        if(!Auth::user()->verified) {
            return back()->with('status', 'warning')->with('message', 'Anda tidak bisa mengakses halaman ini');
        }
        return $next($request);
    }
}
