<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Mail;
use App\Mail\sendGrid;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $currentUser = \Auth::user();
        $email = $currentUser->email;
        
        $auth = base64_encode($email);
        $verify_link = "http://54.237.136.251/auth/".$auth;

        $input = ['message' => $verify_link, 'subject' => 'Email Verification'];
    
        Mail::to($email)->send(new sendGrid($input));

        $this->middleware('guest')->except('logout');
    }
}
