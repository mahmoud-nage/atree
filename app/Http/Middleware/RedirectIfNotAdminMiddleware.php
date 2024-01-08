<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdminMiddleware
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
        if ((!Auth::check()) || (Auth::user()->type != User::ADMIN) ) {
            return redirect(route('dashboard.login_form'))->with('error' , 'قم بتسجيل الدخول ' );
        }
        return $next($request);
    }
}
