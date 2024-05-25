<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;

class RedirectIfPhoneNotVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (!auth()->user()->phone) {
                return redirect(route('site.phone'));
            }
            if (!auth()->user()->phone_verified_at) {
                return redirect(route('verify_phone.index'));
            }
        }
        return $next($request);
    }
}
