<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\RegisterRequest;
use App\Models\User;
use App\Models\EmailVerificationCode;
use Auth;
use Hash;
class RegisterController extends Controller
{

    public function form()
    {
        return view('site.register');
    }

    public function register(RegisterRequest$request)
    {

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->type = 1;
        $user->username = substr(str_shuffle('abcdefghijklmnobqrstuvwxyz'), 0 , 12);
        if ($request->hasFile('image')) {
            $user->image = basename($request->file('image')->store('users'));
        }
        $user->save();
        $code = new EmailVerificationCode;
        // $code->code = substr(str_shuffle(time()),0 , 4) ;
        $code->code = 1234 ;
        $code->email = $user->email;
        $code->save();
        return redirect(url('verify?email='.$user->email ));
    }
}
