<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailVerificationCode;
use App\Models\User;
use Carbon\Carbon;
use Auth;
class VerifyEmailController extends Controller
{


    public function form(Request $request)
    {
        $email = $request->email;
        return view('site.verify' , compact('email') );
    }

    public function verify(Request $request)
    {
        $code = $request->number[0].$request->number[1].$request->number[2].$request->number[3];
        $check = EmailVerificationCode::where([
            ['email' , '=' , $request->email ] , 
            ['code' , '=' , $code ] , 
        ])->first();

        if (!$check) {
            return redirect(url('/verify?email='.$request->email))->with('error' , trans('site.Verification Code is wrong') );
        }

        $check->delete();
        $user = User::where('email' , $request->email )->first();
        if ($user) {
            $user->email_verified_at = Carbon::now();
            $user->save();
            Auth::login($user);
            return redirect(route('profile.index'))->with('success' , trans('site.Account Verified successfully') );
        }
    }
}
