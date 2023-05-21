<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
        $this->validate($request, [
             'email' => 'required',
            'password' => 'required',
        ]);
        $findUser = User::where('email', $request->email)->first();
        if($findUser != null){
                if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
                    // Redirect to dashboard
                    Toastr::success('Successully Logged in !', 'Success');
                    return redirect()->route('home');
                }else{
                    Toastr::error('You password not correct.. !', 'Error');
                    return redirect()->route('login');
                }
        }else{
            Toastr::error('You are not registered.. !', 'Error');
            return redirect()->route('login');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
