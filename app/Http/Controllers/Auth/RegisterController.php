<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Models\Wallet;
use App\Traits\CaptchaTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

use Illuminate\Http\Request;
use DB;
use App\Mail\EmailVerification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,CaptchaTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['captcha'] = $this->captchaCheck();
        $validator = Validator::make($data, [
                'name' => 'required|string|max:64',
                'email' => 'required|string|email|max:64|unique:users',
                'password' => 'required|string|min:6|max:32',
                'password_confirmation' => 'required|string|same:password',
                'g-recaptcha-response'  => 'required',
                'captcha'               => 'accepted'
            ],
            [
                'name.required'         => 'Kolom nama harus diisi',
                'name.string'           => 'Nama harus alfabet',
                'name.max'              => 'Nama tidak boleh lebih dari 64 karakter',
                'email.required'        => 'Kolom email harus diisi',
                'email.unique'          => 'Email sudah terdaftar',
                'email.email'           => 'Email tidak valid',
                'password.required'     => 'Kolom password harus diisi',
                'password.min'          => 'Panjang karakter minimal 6',
                'password.max'          => 'Panjang karakter maksimal 32',
                'g-recaptcha-response.required' => 'Captcha is required',
                'captcha.min'           => 'Wrong captcha, please try again.'
            ]
        );

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(64),
            'activated' => false,
        ]); 

        $role = Role::whereName('user')->first();
        $user->assignRole($role);

        $data['token']  = $user->token;
        $data['email'] = $user->email;
        $data['name'] = $user->name;

        Mail::send('emails.activate', $data, function($message) use ($data)
        {
            $message->from('weniindya@gmail.com', "Anaknegeri");
            $message->subject("Aktivasi akun anda");
            $message->to($data['email'], $data['name']);   
        });
        return $user;
    }

    public function createWallet($id){
        $newWallet= Wallet::create(array(
            'total' => 0
        )); 
        $newWallet->save();
        $newWallet->assignUser($id);
    }

    public function activate($token)
    {
        User::where('token',$token)->firstOrFail()->activated();
        $user = User::where('token', $token)->firstOrFail();

        $this->createWallet($user->id);

        return view('banner.activation-success')
            ->with('message', 'Selamat, akun anda telah aktif!');
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
           $this->throwValidationException(
               $request, $validator
           );
        }

        $this->create($request->all());

        return redirect('/login')
            ->with('message','Registrasi berhasil <br>Silakan cek email untuk aktivasi akun')
            ->with('status', 'success');
    }

}
