<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Auth guard
     *
     * @var
     */
    protected $auth;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new controller instance.
     *
     * LoginController constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->auth = $auth;
        $auth->viaRemember();
    }

    public function login(Request $request)
    {
        $email      = $request->get('email');
        $password   = $request->get('password');
        $remember   = $request->has('remember') ? true : false;

        if ($this->auth->attempt([
            'email'     => $email,
            'password'  => $password
        ], $remember)) {
            if ( $this->auth->user()->hasRole('user') || $this->auth->user()->hasRole('organization')) {

                return redirect()->route('home')
                    ->with('message','Selamat datang, '. $this->auth->user()->name) 
                    ->with('status', 'success');
            }

            if ( $this->auth->user()->hasRole('administrator')) {

            return redirect()->route('admin.index')
                ->with('message','Selamat datang, ')
                ->with('status', 'success');

            }

            if ( $this->auth->user()->hasRole('finance')) {

            return redirect()->route('finance.index')
                ->with('message','Selamat datang, ')
                ->with('status', 'success');

            }

            if ( $this->auth->user()->hasRole('logistic')) {

            return redirect()->route('logistic.index')
                ->with('message','Selamat datang, ')
                ->with('status', 'success'); 

            }
        }
        else {

            return redirect()->back()
                ->with('message','Email atau password salah')
                ->with('status', 'danger')
                ->withInput();
        }

    }

    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        return redirect('/login')
            ->with('message', 'Anda berhasil Logout')
            ->with('status', 'danger');
    }

}