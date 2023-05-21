<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class TwoFactor
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
        $user = auth()->user();
        $verify_code_mas =User::where('verify_code', $request->verify_code)->first();

        if($verify_code_mas)
        {
            if($verify_code_mas->verify_expires_at->lt(now()))
            {
                $verify_code_mas->verify_code = null;
                $verify_code_mas->verify_expires_at = null;
                $verify_code_mas->save();
                /*$user->resetTwoFactorCode();*/
             /*   auth()->logout();*/

                return redirect()->route('otp-verify')
                    ->withMessage('Your Verify code has expired. Please Resend Code.');
            }

            if(!$request->is('verify*'))
            {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
