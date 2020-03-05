<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    public function username(){
        return 'username';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
//        if ( $user && $user->statuslookup_id === 3) {
//            Auth::logout();
//            $errors = [$this->username() => trans('auth.notactivated')];
//            return redirect()->back()
//                ->withErrors($errors);
//        }
//        elseif ( $user && $user->statuslookup_id === 4) {
//            Auth::logout();
//            $errors = [$this->username() => trans('auth.deleted')];
//            return redirect()->back()
//                ->withErrors($errors);
//        }
//        else{
//            return Redirect::to('/')->with('success', 'You have successfully logged in !!!');
//        }



    }
}
