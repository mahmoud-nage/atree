<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function form()
    {
        return view('dashboard.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LoginRequest  $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email' , 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.index'));
        }

        return back()->with('error' , 'بيانات الدخول غير صحيحه' );
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('dashboard.login_form'));
    }

}
