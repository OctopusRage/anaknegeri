<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;


class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!$this->auth->check())
        {
            return redirect()->to('/login')
                ->with('status', 'danger')
                ->with('message', 'Silakan login untuk masuk ke sistem');
        }

        if (config('settings.activation')) {
            if ($this->auth->user()->activated == false) {
                session()->put('banner.status', 'Silakan lakukan aktivasi email. <a href="'. route('authenticated.activation-resend') .'">Resend</a> activation email.');
            } else {
                session()->forget('banner.status');
            }
        }

        if($role == 'all')
        {
            return $next($request);
        }
        if( $this->auth->guest() || !$this->auth->user()->hasRole($role))
        {
            return redirect()->route('forbidden');
        }
        return $next($request);
    }
}
