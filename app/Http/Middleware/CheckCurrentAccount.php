<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCurrentAccount
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
        if(!Auth::user()->isAdmin() && !Auth::user()->isAdminTwo() && !Auth::user()->isAdminThree() ){
            if (Auth::user()->current_account()->first()->account_amount >= 5000000 && Auth::user()->current_account()->first()->approval == 1) {

                return view('freezed');
            }
        }

        return $next($request);
    }
}
