<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Carbon\Carbon;
use Validator;

use Session;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'password_confirmation',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password == $request->password_confirmation){
            $user->password = Hash::make($request->password);
            if($user->save()){
                Toastr::success('Success.', 'Success');
                return redirect()->route('login');
            }else{
                Toastr::error('Something is wrong.. !', 'Error');
                return redirect()->route('register');
            }
        }
        else{
            Toastr::error('Password not matched...!', 'Error');
            return redirect()->route('register');
        }
    }

    protected function create(array $data)
    {
        //
    }
}
