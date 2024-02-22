<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function form()
    {
        return view('site.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email' , 'password']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->with('error' , trans('site.credentials_not_corrent') );
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
