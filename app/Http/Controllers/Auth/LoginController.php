<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = '/home';

    //protected function redirectTo()
    protected $redirectTo;
    //{
        // if(Auth::user()->usertype == 'admin')
        // {
        //     return 'dashboard';
        // }
        // if (Auth::user()->usertype == 'null') {
        //     return 'about';
        // } else {
        //     return 'home';
        // }

        // else
        // {
        //     return 'home';
        // }
    //}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check() && Auth::user()->usertype == 'admin')
        {
            $this->redirectTo = route('dashboard');
        }
        else
        {
            $this->redirectTo = route('company');
        }

        $this->middleware('guest')->except('logout');
    }
}
