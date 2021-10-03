<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifiedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $current_user = User::where('email',Auth::user()->email)->first();
        if($current_user->email_verified_at == null)
        {
            return redirect()->route('loginForm')
                ->with('error','کاربر گرامی حساب کاربری شما فعال نشده است.');
        }
        return $next($request);
    }
}
