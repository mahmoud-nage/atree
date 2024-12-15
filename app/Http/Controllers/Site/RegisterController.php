<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationCodeToViaPhoneNumberJob;
use App\Http\Requests\Site\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function form()
    {
        return view('site.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->type = User::USER;
        $user->username = $request->username;
//        substr(str_shuffle('abcdefghijklmnobqrstuvwxyz'), 0 , 12)
        if ($request->hasFile('image')) {
            $user->image = basename($request->file('image')->store('users'));
        }
        $user->save();
        $credentials = $request->only(['phone' , 'password']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }
//        $code = new EmailVerificationCode;
//        // $code->code = substr(str_shuffle(time()),0 , 4) ;
//        $code->code = 1234 ;
//        $code->email = $user->email;
//        $code->save();
        dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
        return redirect(route('verify_phone.index'))->with('success', __('messages.registered_successfully'));
    }
}
